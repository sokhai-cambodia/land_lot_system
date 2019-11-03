<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use FileHelper;

class User extends Authenticatable
{

    
    use Notifiable;
    use SoftDeletes;

    protected $table = 'users';

    protected $guarded = [];
    private $PATH = 'assets/uploads/profile';
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * Define Relationship
     */

    public function getFullName()
    {
        return $this->last_name.' '.$this->first_name;
    }

    public function getPhoto()
    {
        return asset(FileHelper::hasImage($this->image));
    }

    // Role
    
    public function role()
    {
        return $this->belongsTo('App\Role');
    }

}
