<?php
namespace App\Repositories;

use App\Models\Historique;

class HistoriqueRepository extends ResourceRepository
{

	public function __construct(Historique $historique)
	{
		$this->model = $historique;
	}

}
