<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repertoire extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'repertoires';

    /**
     * The attributes that are mass assignable.
     *
     * @var array 
     */
    protected $fillable = [
        'libelle','description','etat','user_id'
    ];

    /**
     * Dans un repertoire on a plusieurs contact
     */
    public function contacts()
    {
        return $this->hasMany('App\Models\Contact');
    }

     /**
     * Un repertoire appartient a un utilisateur
     */
    public function utilisateur()
    {
        return $this->belongsTo('App\User');
    }

        /**
     * Dans un repertoire on a plusieurs message
     */
    public function messages()
    {
        return $this->belongsToMany('App\Models\Message');
    }
}
