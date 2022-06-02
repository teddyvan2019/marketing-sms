<?php
namespace App\Repositories;

use App\User;

class UserRepository extends ResourceRepository
{
	public function __construct(User $user)
	{
		$this->model = $user;
	}

	/**
	 * Retourne les informations sur l'utilsateur repondant au critere passée en parametre
	 * Pour la recherche avancé
	 */
	public function isExistUser($email,$pass)
    {
		return User::where('email',  $email)
					->Where('password', $pass)
					->get()->count();
	}
}
