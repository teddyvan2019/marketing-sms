<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anniversaire extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'anniversaires';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'libelle','description','dateDebut','dateFin','etat'
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

     public function messageanniversaires()
    {
        return $this->hasMany('App\Models\MessageAnniversaire');
    }
}
