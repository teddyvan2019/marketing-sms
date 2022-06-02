<?php
namespace App\Repositories;

use App\Models\MessageSendCampagne;

class MessageSendCampagneRepository extends ResourceRepository
{
	public function __construct(MessageSendCampagne $messagesendcampagne)
	{
		$this->model = $messagesendcampagne;
	}

	/**
	 * Retourne les Messages par campagne
	 */
	public function getMessageByCampagneId($campagne_id, $nbrePage)
	{
		return  MessagesCampagnes::where('campagne_id', $campagne_id)
							->paginate($nbrePage);
	}


	public function getCampagneName($id)
	{
		return MessagesCampagnes::with('campagne')->get();
	}
	
	/**
	*Retourne les messahge programme pour la campagne 
	dont la date d'envoi est aujourd'hui et 
	qui nont pas encore ete envoye ( etat = 1)
	*
	*/
	public function getMessageProgrammePourLaCampagne($idCampagne, $dateActuel)
	{
		//recuperation de 
       return  MessagesCampagnes::where('campagne_id', $idCampagne)
                                ->where('dateEnvoi', '=', $dateActuel)
								->where('etat',1)
								->get();
	}

	/**
	*Retourne les message(de facons automatique) envoyé pour la campagne 
	
	*
	*/
	public function getInfOfUserMessageDetail($idMessage, $nbrePage)
	{
		//recuperation des msg envoyer
       return  MessageSendCampagne::where('message_id', $idMessage)
								->paginate($nbrePage);
	}


}