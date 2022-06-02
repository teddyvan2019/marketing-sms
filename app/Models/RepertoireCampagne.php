<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RepertoireCampagne extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'repertoire_campagnes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'messages_id','repertoire_id'
    ];

    /**
     * Le repertoire_id correspond a un repertoire
     */
    public function repertoire()
    {
        return $this->belongsTo('App\Models\Repertoire','repertoire_id');
    }
    /**
     * Le messages_id correspond a un message
     */
    public function message()
    {
        return $this->belongsTo('App\Models\MessagesCampagnes','messages_id');
    }
}
