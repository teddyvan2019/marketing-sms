<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'genres';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'libelle'
    ];

     /**
     * Un genre regroupe plusieur contact
     */
    public function contacts()
    {
        return $this->hasMany('App\Models\Contact');
    }
}
