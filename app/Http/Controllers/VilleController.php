<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateVilleRequest;
use App\Http\Requests\UpdateVilleRequest;

use App\Repositories\VilleRepository;
use Session;

class VilleController extends Controller
{
    protected $villeRepository;
    protected $nbrPerPage = 10; //10 enregistrement par page

    public function __construct(VilleRepository $villeRepository)
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('ajax', ['only' => 'store']);

		$this->villeRepository = $villeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $villes = $this->villeRepository->getPaginate($this->nbrPerPage);
        $links = $villes->render();// pour la pagination
        // dd($villes);
		return view('ville.index', compact('villes', 'links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ville.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateVilleRequest $request)
    {
        $ville = $this->villeRepository->store($request->all());

        Session::flash('success',"La ville $ville->libelle a été effectue avec success");

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
        $ville = $this->villeRepository->getById($id);
        return view('ville.show',compact('ville'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ville = $this->villeRepository->getById($id);
        return view('ville.edit',compact('ville'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVilleRequest $request, $id)
    {
        $this->villeRepository->update($id, $request->all());
        return redirect('villes')->with('success', "La ville " . $request->input('libelle') . " a été modifiée.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->villeRepository->destroy($id);
        Session::flash('success','La suppression a été effectue avec success'); 
        
        return back();
    }
}
