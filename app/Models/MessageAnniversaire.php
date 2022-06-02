<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageAnniversaire extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'message_anniversaires';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'num_reception','message','dateEnvoi','heureEnvoi','anniversaire_id'
    ];

    /**
     * Dans un repertoire on a plusieurs contact
     */
    public function repertoires()
    {
        return $this->belongsToMany('App\Models\Repertoire');
    }

     /**
     * Un repertoire appartient a un utilisateur
     */
    public function utilisateur()
    {
        return $this->belongsTo('App\User');
    }


    /**
     * Dans un message on a un anniversaire
     */
    public function anniversaire()
    {
        return $this->hasMany('App\Models\Anniversaire');
    }
}
