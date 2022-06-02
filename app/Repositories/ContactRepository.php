<?php
namespace App\Repositories;

use App\Models\Contact;

class ContactRepository extends ResourceRepository
{
	public function __construct(Contact $contact)
	{
		$this->model = $contact;
	}

	/**
	 * Retourne la liste des contacts d'un repertoire 
	 */
	public function getContactByRepertoireId($repertoire_id, $nbrePage)
	{

		return  Contact::where('repertoire_id', $repertoire_id)
						->paginate($nbrePage);
	}

	/**
	 * Retourne tous les contacts d'un repertoire 
	 */
	public function getTousContactByRepertoireId($repertoire_id)
	{

		return  Contact::where('repertoire_id', $repertoire_id)
						->get();
	}

/**
	 * Retourne nombre contacts du repertoire 
	 */
	public function getNombreContactDuRepertoire($repertoire_id)
	{

		return  Contact::where('repertoire_id', $repertoire_id)
						->count();
	}


}