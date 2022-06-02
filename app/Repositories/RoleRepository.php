<?php
namespace App\Repositories;

use App\Models\Role;

class RoleRepository extends ResourceRepository
{

	public function __construct(Role $role)
	{
		$this->model = $role;
	}

	/**
	 * Retourne la liste des roles utilisateurs
	 */
	public function getAllRole()
    {
       return  Role::all();
    }
}
