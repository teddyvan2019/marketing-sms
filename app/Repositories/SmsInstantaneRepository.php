<?php
namespace App\Repositories;

use App\Models\SmsInstantane;

class SmsInstantaneRepository  extends ResourceRepository
{
public function __construct(SmsInstantane $smsinstantane)
	{
		$this->model = $smsinstantane;
	}

	/**
	 * Retourne les les SmsInstantane  du clients
	 */
	public function getSmsInstantaneByUserId($user_id, $nbrePage)
	{
		return  SmsInstantane::where('user_id', $user_id)
							// ->where('etat',1)
							->paginate($nbrePage);
	}
	
	/**
	 * Pour effacer les smsinstantane  du clients 
	 */
	public function getSmsInstantaneDeleteByUserId($id)
	{
		return  SmsInstantane::where('id', $id)
							->update(['etat'=>3]);
	}
	
	
	
	
}