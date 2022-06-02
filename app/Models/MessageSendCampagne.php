<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageSendCampagne extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'message_sent_campagnes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message_id','destinataire','from','dateHeure','message','dlr'
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
     * Dans un message on a un campagne
     */
    public function campagne()
    {
        return $this->hasMany('App\Models\Campagne', 'campagne_id');
    }
}

