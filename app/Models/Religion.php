<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'religions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'libelle'
    ]; 

    /**
     * Une religion regroupe plusieurs contact
     */
    public function contacts()
    {
        return $this->hasMany('App\Models\Contact');
    }
}
