<?php
namespace App\Repositories;

use App\Models\RepertoireCampagne;

class MessageRepertoireRepository extends ResourceRepository
{
	public function __construct(RepertoireCampagne $messagerepertoire )
	{
		$this->model = $messagerepertoire ;
	}

	/**
	 * Retourne les repertoires selectionne lors de la programmation du message
	 */
	public function getrepertoireSelectionneLorsDeLaProgrammationDuMessage($idMessageProgramme)
	{
		return  RepertoireCampagne::where('messages_id', $idMessageProgramme)
							->get();
	}

	public function deleteByIdMessage($idMessageProgramme)
	{
		return  RepertoireCampagne::where('messages_id', $idMessageProgramme)
							->delete();
	}
	
}