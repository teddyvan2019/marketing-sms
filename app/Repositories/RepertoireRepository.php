<?php
namespace App\Repositories;

use App\Models\Repertoire;

class RepertoireRepository extends ResourceRepository
{
	public function __construct(Repertoire $repertoire)
	{
		$this->model = $repertoire;
	}

	/**
	 * Retourne les repertoires du clients
	 */
	public function getRepertoireByUserId($user_id, $nbrePage)
	{
		return  Repertoire::where('user_id', $user_id)
							->paginate($nbrePage);
	}

	/**
	 * Retourne les repertoires actifs du clients
	 */
	public function getRepertoireActifByUserId($user_id)
	{
		return  Repertoire::where('user_id', $user_id)
							->where('etat',1)
							->get();
	}

/**
	 * Retourne nombre des repertoires actifs du clients
	 */
	public function getNombreRepertoireByUserId($user_id)
	{
		return  Repertoire::where('user_id', $user_id)
							->count();
	}

		/**
	 * Retourne les repertoires du clients
	 */
	public function getRepertoiresByUserId($user_id)
	{
		return  Repertoire::where('user_id', $user_id)
							->get();
	}

	
}