<?php
namespace App\Repositories;

use App\Models\Campagne;

class CampagneRepository extends ResourceRepository
{
	public function __construct(Campagne $campagne)
	{
		$this->model = $campagne;
	}

	/**
	 * Retourne les campagnes du clients 
	 */
	public function getCampagneByUserId($user_id, $nbrePage)
	{
		return  Campagne::where('user_id', $user_id)
		                    ->where('etat',1)
							->paginate($nbrePage);
	}

	/**
	 * Retourne les campagnes du client creer entre la date de debut et de fin selectionné par le client 
	 */
	public function getCampagneByUserIdEntreDateDebutDateFin($user_id,$date_dedut,$date_fin)
	{
		return  Campagne::where('user_id', $user_id)
		                    ->where('etat','!=', 3)
		                    ->whereBetween('created_at',[$date_dedut,$date_fin] )
							->get();
	}

	/**
	 * Retourne les campagnes actifs du clients
	 */
	public function getCampagneActifByUserId($user_id)
	{
		return  Campagne::where('user_id', $user_id)
							->where('etat',1)
							->get();
	}

	/**
	 * Pour effacer les campagne  du clients 
	 */
	public function getCampagneDeleteByUserId($id)
	{
		return  Campagne::where('id', $id)
							->update(['etat'=>3]);
	}

	/**
	* Retourne les campagnes dont la date de debut est arrive
	*/
	public function getCampagnesByDate($dateActuel)
	{
		return  Campagne::where('dateDebut', '<=',$dateActuel)
	                    ->where('dateFin', '>=', $dateActuel)
	                    ->where('etat',1)
						->get();
	}


}