<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'villes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'libelle'
    ];

    /**
     * Dans une ville on a plusieurs contact
     */
    public function contacts()
    {
        return $this->hasMany('App\Models\Contact');
    }
}
