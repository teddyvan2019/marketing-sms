<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Repositories\RepertoireRepository;
use App\Repositories\ContactRepository;
use App\Repositories\CampagneRepository;
use App\Http\Requests\CreateCampagneRequest;
use App\Http\Requests\UpdateCampagneRequest;


use Session;


class CampagneController extends Controller 
{

    //protected $smsinstantaneRepository;
    protected $campagneRepository;
    protected $nbrPerPage = 30; //30 enregistrement par page

    public function __construct(RepertoireRepository $repertoireRepository,
                                ContactRepository $contactRepository,CampagneRepository $campagneRepository)
    {
        $this->middleware('auth');
        $this->middleware('ajax', ['only' => 'store,update']);

        $this->campagneRepository = $campagneRepository;
        $this->repertoireRepository = $repertoireRepository;
        $this->contactRepository = $contactRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user_id = auth()->user()->id;
        $campagnes = $this->campagneRepository->getCampagneByUserId($user_id, $this->nbrPerPage);
        $links = $campagnes->render();// pour la pagnination
        return view('campagne.index', compact('campagnes','links','user_id'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
   
        return view('campagne.create');
 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCampagneRequest $request)
    {   
        $dateActuel =  @gmdate('Y-m-d');
        $request->merge(['user_id' => auth()->user()->id]); // recuperation de id du user 

        $date_debut = $request->dateDebut;
        $date_fin =  $request->dateFin;
        if (($date_debut > $date_fin)||($date_debut < $dateActuel) )
        {
            Session::flash('error', "Impossible d'éffectuer cette action car la date la date selectionnée est invalide.");
            return view('campagne.create');
        }
        
        $campagne = $this->campagneRepository->store($request->all());

        Session::flash('success',"La campagne " .$campagne->libelle. " a été creé."); 

        return response()->json();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $user_id = auth()->user()->id;
        $repertoires = $this->repertoireRepository->getRepertoireByUserId($user_id, $this->nbrPerPage);
        $links = $repertoires->render();// pour la pagination

        $repertoiresActifs = $this->repertoireRepository->getRepertoireActifByUserId($user_id);
        $campagne = $this->campagneRepository->getById($id);
         return view('campagne.show', compact('campagne','repertoiresActifs', 'links'));
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $campagne = $this->campagneRepository->getById($id);
        return view('campagne.edit', compact('campagne'));
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCampagneRequest $request, $id)
    { 

     $this->campagneRepository->update($id, $request->all());
     return redirect('campagne')->with('success', "La campagne a été modifié.");
  
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $this->campagneRepository->getCampagneDeleteByUserId($id);
     return redirect('campagne')->with('success', "Le message instantané  a été supprimé.");


    }

     /**
     * Active la campagne
     */
     public function activer($id)
     {

        $campagne = $this->campagneRepository->getById($id);
        if (!empty($campagne)) {
            $this->campagneRepository->update($id, array('etat' => 1));
        
           Session::flash('success',"La campagne " .$campagne->libelle. " a été activée avec success"); 
        }
        else
        {
            Session::flash('danger',"Cete campagne n'existe pas ");  
        }
        
        return back();
    }

    /**
     * Desactive le campagne
     */
    public function desactiver($id)
    {
        $campagne = $this->campagneRepository->getById($id);

        if(!empty($campagne))
        {
            $this->campagneRepository->update($id, array('etat' => 0));
            Session::flash('success',"La campagne " .$campagne->libelle. " a été desactivée avec success"); 
        }
        else
        {
            Session::flash('danger',"Cete campagne n'existe pas ");  
        }
        
        return back();
    }
    
}
