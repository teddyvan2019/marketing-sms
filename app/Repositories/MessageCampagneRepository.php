<?php
namespace App\Repositories;

use App\Models\MessagesCampagnes;

class MessageCampagneRepository extends ResourceRepository
{
	public function __construct(MessagesCampagnes $messagecampagne)
	{
		$this->model = $messagecampagne;
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
	 * Retourne les messages des campagnes
	 * programme pour aujourd'hui et qui nont pas encore ete envoye ( etat = 1)
	*
	*/
	public function getMessageAEnvoyerTodayAndNow($dateActuel,$heureEnvoi)
	{
		//recuperation de 
       return  MessagesCampagnes::where('dateEnvoi', '=', $dateActuel)
								->where('heureEnvoi','<=', $heureEnvoi)
								->where('etat',1)
								->get();
	}

   //Retourne les messahge programme pour la campagne
	public function getNombreMessageByCampagneId($campagne_id)
	{
		return  MessagesCampagnes::where('campagne_id', $campagne_id)
							->get();
	}
}