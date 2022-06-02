<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateGenreRequest;
use App\Http\Requests\UpdateGenreRequest;

use App\Repositories\GenreRepository;
use Session;

class GenreController extends Controller
{
    protected $genreRepository;
    protected $nbrPerPage = 10; //10 enregistrement par page

    public function __construct(GenreRepository $genreRepository)
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('ajax', ['only' => 'store']);

		$this->genreRepository = $genreRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genres = $this->genreRepository->getPaginate($this->nbrPerPage);
        $links = $genres->render();// pour la pagination
        // dd($genres);
		return view('genre.index', compact('genres', 'links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('genre.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateGenreRequest $request)
    {
        $genre = $this->genreRepository->store($request->all());

        Session::flash('success',"La genre $genre->libelle a été effectue avec success");

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
        $genre = $this->genreRepository->getById($id);
        return view('genre.show',compact('genre'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $genre = $this->genreRepository->getById($id);
        return view('genre.edit',compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGenreRequest $request, $id)
    {
        $this->genreRepository->update($id, $request->all());
        return redirect('genres')->with('success', "La genre " . $request->input('libelle') . " a été modifiée.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->genreRepository->destroy($id);
        Session::flash('success','La suppression a été effectue avec success'); 
        
        return back();
    }
}
