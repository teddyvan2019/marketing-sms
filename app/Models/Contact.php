<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contacts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom','prenom','date_naissance','telephone','profession','email','date_relance','repertoire_id','ville_id','religion_id','sexe_id'
    ];

    /**
     * Un contact est a un repertoire
     */
    public function repertoire()
    {
        return $this->belongsTo('App\Models\Repertoire');
    }

    /**
     * Un contact est ratacheé a une ville
     */
    public function ville()
    {
        return $this->belongsTo('App\Models\Ville');
    }

    /**
     * Un contact a une religion
     */
     public function religion()
    {
        return $this->belongsTo('App\Models\Religion');
    }

    /**
     * Un contact a un genre
     */
     public function sexe()
    {
        return $this->belongsTo('App\Models\Genre');
    }
}
