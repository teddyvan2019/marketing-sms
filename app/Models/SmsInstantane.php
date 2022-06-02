<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsInstantane extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sms_instantanes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'destinataire','from','message','dateHeure','etat','dlr','user_id'
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
