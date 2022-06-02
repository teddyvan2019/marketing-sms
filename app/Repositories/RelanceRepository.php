<?php
namespace App\Repositories;

use App\Models\Relance;

class RelanceRepository extends ResourceRepository
{
	public function __construct(Relance $Relance)
	{
		$this->model = $Relance;
	}

	
}