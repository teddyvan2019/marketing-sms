<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessagesCampagnes extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'messages_campagnes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'campagne_id','repertoire_id','dateEnvoi','heureEnvoi','message','etat'
    ];

    /**
     * Dans un repertoire on a plusieurs contact
     */
    public function repertoire()
    {
        return $this->belongsToMany('App\Models\Repertoire','repertoire_id');
    }

     /**
     * Un repertoire appartient a un utilisateur
     */
    public function utilisateur()
    {
        return $this->belongsTo('App\User');
    }


    /**
     * Dans un message on a un campagne
     */
    public function campagne()
    {
        return $this->hasMany('App\Models\Campagne', 'campagne_id');
    }
}
