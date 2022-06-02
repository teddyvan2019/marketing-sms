<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relance extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'relances';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'num_reception','libelle','description','dateDebut','dateFin','message'
    ];

    /**
     * Dans un repertoire on a plusieurs contact
     */
    public function repertoires()
    {
        return $this->hasMany('App\Models\Repertoire');
    }

     /**
     * Un repertoire appartient a un utilisateur
     */
    public function utilisateur()
    {
        return $this->belongsTo('App\User');
    }
}
