<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateContactRequest;
// use App\Http\Requests\CreateContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;

use App\Repositories\ContactRepository;
use App\Repositories\VilleRepository;
use App\Repositories\GenreRepository;
use App\Repositories\ReligionRepository;
use App\Repositories\RepertoireRepository;
use DB;
use Excel;
use Session;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $contactRepository;
    protected $villeRepository;
    protected $genreRepository;
    protected $religionRepository;
    protected $repertoireRepository;
    protected $nbrPerPage = 200; //200 enregistrement par page

    public function __construct(RepertoireRepository $repertoireRepository,ContactRepository $contact,VilleRepository $VilleRepository,GenreRepository $GenreRepository,ReligionRepository $ReligionRepository)
    {
        $this->middleware('auth');
        $this->middleware('ajax', ['only' => 'store']);

        $this->contactRepository = $contact;
        $this->repertoireRepository = $repertoireRepository;
		$this->villeRepository = $VilleRepository;
		$this->genreRepository = $GenreRepository;
		$this->religionRepository = $ReligionRepository;
    }

    /**
     * Display a listing of the resource.
     * Retourne les contact de l'utilisateur connecté
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    // importation des contacts


    
    /**
     * Retourne la liste des contacts d'un repertoire
     */
    public function contactByIdRepertoire($repertoire_id)
    {
        $contacts = $this->contactRepository->getContactByRepertoireId($repertoire_id, $this->nbrPerPage);
        $links = $contacts->render();// pour la pagination

        $villes = $this->villeRepository->getAll() ;
		$genres = $this->genreRepository->getAll() ;
        $religions = $this->religionRepository->getAll() ;
        $repertoire = $this->repertoireRepository->getById($repertoire_id);

        // dd($contacts);
		return view('contact.index', compact('contacts','repertoire','links','villes','genres','religions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response 
     */
    public function store(CreateContactRequest $request)
    {

        $contact = $this->contactRepository->store($request->all());
        
        Session::flash('success',"La contact " .$contact->nom. " ".$contact->prenom." a été créée"); 

        return response()->json();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response 
     */
    public function storebyFile(CreateContactRequest $request)
    {

        $contact = $this->contactRepository->store($request->all());
        
        Session::flash('success',"La contact " .$contact->nom. " ".$contact->prenom." a été créée"); 

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
        $contact = $this->contactRepository->getById($id);
        return view('contact.show',compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = $this->contactRepository->getById($id);
        $villes = $this->villeRepository->getAll() ;
		$genres = $this->genreRepository->getAll() ;
        $religions = $this->religionRepository->getAll() ;
        // dd($contact);
        return view('contact.edit',compact('contact','villes','genres','religions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactRequest $request, $id)
    {
        $this->contactRepository->update($id, $request->all());
        Session::flash('success',"Le contact " . $request->input('nom') .' ' .$request->input(''). " a été modifiée."); 
		return back();
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->contactRepository->destroy($id);
        Session::flash('success',"Le contact " .$contact->libelle. " a été supprimé avec success"); 
		return back();
    }

    /**
     * Active le contact
     */
    public function activer($id)
    {
      $contact = $this->contactRepository->getById($id);
        
        if(!empty($contact))
        {
            $this->contactRepository->update($id, array('etat' => 1));
            Session::flash('success',"Le contact " .$contact->libelle. " a été activé avec success"); 
        }
        else
        {
            Session::flash('danger',"Ce contact n'existe pas ");  
        }
        
		return back();
    }

    /**
     * Desactive le contact
     */
    public function desactiver($id)
    {
        $contact = $this->contactRepository->getById($id);

        if(!empty($contact))
        {
            $this->contactRepository->update($id, array('etat' => 0));
            Session::flash('success',"Le contact " .$contact->libelle. " a été desactivé avec success"); 
        }
        else
        {
            Session::flash('danger',"Ce contact n'existe pas ");  
        }

		return back();
    }
}
