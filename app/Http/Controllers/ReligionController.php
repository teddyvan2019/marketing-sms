<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateReligionRequest;
use App\Http\Requests\UpdateReligionRequest;

use App\Repositories\ReligionRepository;
use Session;

class ReligionController extends Controller
{
    protected $religionRepository;
    protected $nbrPerPage = 10; //10 enregistrement par page

    public function __construct(ReligionRepository $religionRepository)
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('ajax', ['only' => 'add']);

		$this->religionRepository = $religionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $religions = $this->religionRepository->getPaginate($this->nbrPerPage);
        $links = $religions->render();// pour la pagination
        // dd($religions);
		return view('religion.index', compact('religions', 'links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('religion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateReligionRequest $request)
    {
        // $request->merge(['etat' => 1]); //par defaut l'etat est actif a 1

        $religion = $this->religionRepository->store($request->all());

        return redirect('religions')->with('success', "La religion " .$religion->libelle. " a été créée");

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $religion = $this->religionRepository->getById($id);
        return view('religion.show',compact('religion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $religion = $this->religionRepository->getById($id);
        return view('religion.edit',compact('religion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReligionRequest $request, $id)
    {
        $this->religionRepository->update($id, $request->all());
        return redirect('religions')->with('success', "La réligion " . $request->input('libelle') . " a été modifiée.");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->religionRepository->destroy($id);
        Session::flash('success','La suppression a été effectue avec success'); 
        return back();
    }
}
