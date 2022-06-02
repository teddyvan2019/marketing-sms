<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * un utilisateur a un role
     */
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    /**
     * Un utilisateur a plusieurs repertoire
     */
    public function repertoires()
    {
        return $this->hasMany('App\Models\Repertoire');
    }

    /**
     * Un utilisateur a plusieurs smsinstantanes
     */
    public function smsinstantanes()
    {
        return $this->hasMany('App\Models\SmsInstantane');
    }

    /**
     * Un utilisateur a plusieurs campagnes
     */
    public function campagnes()
    {
        return $this->hasMany('App\Models\Campagne');
    }
}
