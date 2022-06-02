<?php
namespace App\Repositories;

use App\Models\Ville;

class VilleRepository extends ResourceRepository
{
	public function __construct(Ville $ville)
	{
		$this->model = $ville;
	}

}