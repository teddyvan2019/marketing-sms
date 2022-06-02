<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campagne extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'campagnes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'libelle','description','etat','dateDebut','dateFin','user_id'
    ];

    /**
     * Dans un repertoire on a plusieurs contact
     */
    public function repertoires()
    {
        return $this->ToMany('App\Models\Repertoire');
    }

     /**
     * Un repertoire appartient a un utilisateur
     */
    public function utilisateur()
    {
        return $this->belongsTo('App\User');
    }


    /**
     * Dans un campagne on a plusieurs messages
     */
    public function messages()
    {
        return $this->hasMany('App\Models\MessagesCampagnes');
    }
}
