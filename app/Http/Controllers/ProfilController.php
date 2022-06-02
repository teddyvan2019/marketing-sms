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
class ProfilController extends Controller
{
    protected $userRepository;
    protected $roleRepository;
    protected $historique;


    protected $nbrPerPage = 10;

    public function __construct(HistoriqueRepository $historique,UserRepository $userRepository, RoleRepository $roleRepository)
    {
        $this->middleware('auth');
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
        $user = auth()->user();

        $data = array('action' => 'AFFICHAGE_PROFIL_UTILISATEUR', 'username' => auth()->user()->email);
        $this->historique->store($data);
        
        return view('profil.index', compact('user'));
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
        
        $data = array('action' => 'MAJ_PROFIL_UTILISATEUR: '.$request->input('libelle'), 'username' => auth()->user()->email);
        $this->historique->store($data);
        
        return redirect('profil')->withOk("Les informations du profil ont été modifiée.");

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

		return view('profil.edit_password',  compact('user'));
	}


    /**
     * Modifie le mot de passe
     */
    public function updatePWD(UpdateUserPasswordRequest $request, $id)
	{
        $etat = $this->userRepository->update($id, $request->all());
        if($etat)
        {
            $data = array('action' => 'MAJ_PASSWORD_PROFIL_UTILISATEUR: '.$request->input('libelle'), 'username' => auth()->user()->email);
            $this->historique->store($data);
        }
        return redirect('profil')->withOk("Votre mot de passe a été modifiée.");
    }
	
}
