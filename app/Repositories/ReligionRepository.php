<?php
namespace App\Repositories;

use App\Models\Religion;

class ReligionRepository extends ResourceRepository
{
	public function __construct(Religion $religion)
	{
		$this->model = $religion;
	}


}