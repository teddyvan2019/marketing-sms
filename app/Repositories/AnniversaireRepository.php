<?php
namespace App\Repositories;

use App\Models\Anniversaire;

class AnniversaireRepository extends ResourceRepository
{
	public function __construct(Anniversaire $anniversaire)
	{
		$this->model = $anniversaire;
	}

/**
	 * Retourne les Messages par campagne
 */
	public function getMessageByAnniversaireId($anniversaire_id, $nbrePage)
	{
		return  Message::where('anniversaire_id', $anniversaire_id)
							->paginate($nbrePage);
	}
}