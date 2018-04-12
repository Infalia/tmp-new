<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
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
     * The associations that belong to the user.
     *
     * @return App\Association|null
     */
    public function association()
    {
        return $this->hasOne('App\Association');
    }    
    
    /**
     * The initiatives that belong to the user.
     *
     * @return App\Initiative|null
     */
    public function initiatives()
    {
        return $this->hasMany('App\Initiative');
    }

    /**
     * Get user comments.
     *
     * @return App\Comment|null
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
