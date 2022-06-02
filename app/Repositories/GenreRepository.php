<?php
namespace App\Repositories;

use App\Models\Genre;

class GenreRepository extends ResourceRepository
{
	public function __construct(Genre $genre)
	{
		$this->model = $genre;
	}

}