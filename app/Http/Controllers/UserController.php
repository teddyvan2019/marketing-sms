<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UpdateUserPasswordRequest;
use App\Repositories\UserRepository;
use App\Repositories\RoleRepository;
use App\Repositories\HistoriqueRepository;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class UserController extends Controller
{ 
    protected $userRepository;
    protected $roleRepository;
    protected $historique;

    protected $nbrPerPage = 10;

    public function __construct(HistoriqueRepository $historique,UserRepository $userRepository, RoleRepository $roleRepository)
    {
        $this->middleware('auth');
        $this->middleware('admin');
		$this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->historique = $historique;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
	{
		$users = $this->userRepository->getPaginate($this->nbrPerPage);
		$links = $users->render();

        $data = array('action' => 'AFFICHAGE_LISTE_UTILISATEUR', 'username' => auth()->user()->email);
        $this->historique->store($data);

		return view('user.index', compact('users', 'links'));
	}

    /** 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
	{
        $roles = $this->roleRepository->getAllRole();

        $data = array('action' => 'AFFICHAGE_FORMULAIRE_AJOUT_UTILISATEUR', 'username' => auth()->user()->email);
        $this->historique->store($data);

		return view('user.create',compact('roles'));
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
	{
		$user = $this->userRepository->store($request->all());
        if($user)
        {
            $data = array('action' => 'AJOUT_UTILISATEUR: '.$user->name, 'username' => auth()->user()->email);
            $this->historique->store($data);
        }

        Session::flash('success',"L'utilisateur " . $user->name . " a été créé."); 
		return back(); 
        
	}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
	{        
		$user = $this->userRepository->getById($id);
        
        $data = array('action' => 'AFFICHAGE_DETAILS_UTILISATEUR: '.$user->name, 'username' => auth()->user()->email);
        $this->historique->store($data);
        
        return view('user.show',  compact('user'));
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
	{
        $roles = $this->roleRepository->getAllRole();
        $user = $this->userRepository->getById($id);

        $data = array('action' => 'AFFICHAGE_FORMULAIRE_MAJ_UTILISATEUR: '.$user->name, 'username' => auth()->user()->email);
        $this->historique->store($data);

		return view('user.edit',  compact('user','roles'));
    }
    
    /**
     * Show the form for editing the password specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPassword($id)
	{
        $user = $this->userRepository->getById($id);

        $data = array('action' => 'AFFICHAGE_FORMULAIRE_MAJ_UTILISATEUR: '.$user->name, 'username' => auth()->user()->email);
        $this->historique->store($data);

		return view('user.edit_password',  compact('user'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
	{
        $this->userRepository->update($id, $request->all()); 
        
        $data = array('action' => 'MAJ_UTILISATEUR: '.$request->input('libelle'), 'username' => auth()->user()->email);
        $this->historique->store($data);
        
        Session::flash('success',"L'utilisateur " . $request->input('email') . " a été modifiée."); 
		return back(); 
    }

    /**
     * Modifie le mot de passe
     */
    public function updatePWD(UpdateUserPasswordRequest $request, $id)
	{
        $etat = $this->userRepository->update($id, $request->all());
        if($etat)
        {
            $data = array('action' => 'MAJ_PASSWORD_UTILISATEUR: '.$request->input('libelle'), 'username' => auth()->user()->email);
            $this->historique->store($data);
        }
        Session::flash('success',"Le mot de passe de l'utilisateur " . $request->input('email') . " a été modifiée."); 
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
        $user = $this->userRepository->getById($id);
        $this->userRepository->destroy($id);
        if($user)
        {
            $data = array('action' => 'SUPPRESSION_UTILISATEUR: '.$user->email, 'username' => auth()->user()->email);
            $this->historique->store($data);
        }
        Session::flash('success',"Suppression effectué avec success."); 
		return back();

	}	
}
