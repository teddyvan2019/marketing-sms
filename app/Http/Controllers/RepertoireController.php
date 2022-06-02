<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateRepertoireRequest;
use App\Http\Requests\UpdateRepertoireRequest;

use App\Repositories\RepertoireRepository;
use App\Repositories\HistoriqueRepository;
use App\Repositories\VilleRepository;
use App\Repositories\GenreRepository;
use App\Repositories\ReligionRepository;

use Session;

use Illuminate\Http\Request;

class RepertoireController extends Controller
{
    protected $repertoireRepository;
    protected $nbrPerPage = 30; //30 enregistrement par page

    public function __construct(RepertoireRepository $repertoireRepository,VilleRepository $VilleRepository,GenreRepository $GenreRepository,ReligionRepository $ReligionRepository)
    {
        $this->middleware('auth');
        $this->middleware('ajax', ['only' => 'store,update']);

        $this->repertoireRepository = $repertoireRepository;
        $this->villeRepository = $VilleRepository;
		$this->genreRepository = $GenreRepository;
		$this->religionRepository = $ReligionRepository;
    }

    /**
     * Display a listing of the resource.
     * Retourne les repertoire de l'utilisateur connecté
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $repertoires = $this->repertoireRepository->getPaginate($this->nbrPerPage);

        $user_id = auth()->user()->id;
        $repertoires = $this->repertoireRepository->getRepertoireByUserId($user_id, $this->nbrPerPage);
        $links = $repertoires->render();// pour la pagination

        $repertoiresActifs = $this->repertoireRepository->getRepertoireActifByUserId($user_id);

        $villes = $this->villeRepository->getAll() ;
		$genres = $this->genreRepository->getAll() ;
		$religions = $this->religionRepository->getAll() ;
        
        // dd($repertoires);
		return view('repertoire.index', compact('repertoires','repertoiresActifs', 'links','villes','genres','religions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('repertoire.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response 
     */
    public function store(CreateRepertoireRequest $request)
    {
        $request->merge(['user_id' => auth()->user()->id ]); //ajout du user_id est actif a 1

        $repertoire = $this->repertoireRepository->store($request->all());
        
        Session::flash('success',"La répertoire " .$repertoire->libelle. " a été créée"); 

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
        $repertoire = $this->repertoireRepository->getById($id);
        return view('repertoire.show',compact('repertoire'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $repertoire = $this->repertoireRepository->getById($id);
        return view('repertoire.edit',compact('repertoire'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRepertoireRequest $request, $id)
    {
        $this->repertoireRepository->update($id, $request->all());
        return redirect('repertoires')->with('success', "La répertoire " . $request->input('libelle') . " a été modifiée.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repertoireRepository->destroy($id);
        Session::flash('success',"Le repertoire a été supprimé avec success"); 
		return back();
    } 

    /**
     * Active le repertoire
     */
    public function activer($id)
    {
        $repertoire = $this->repertoireRepository->getById($id);
        
        if(!empty($repertoire))
        {
            $this->repertoireRepository->update($id, array('etat' => 1));
            Session::flash('success',"Le repertoire " .$repertoire->libelle. " a été activé avec success"); 
        }
        else
        {
            Session::flash('danger',"Ce repertoire n'existe pas ");  
        }
        
		return back();
    }

    /**
     * Desactive le repertoire
     */
    public function desactiver($id)
    {
        $repertoire = $this->repertoireRepository->getById($id);

        if(!empty($repertoire))
        {
            $this->repertoireRepository->update($id, array('etat' => 0));
            Session::flash('success',"Le repertoire " .$repertoire->libelle. " a été desactivé avec success"); 
        }
        else
        {
            Session::flash('danger',"Ce repertoire n'existe pas ");  
        }
        
		return back();
    }
}
