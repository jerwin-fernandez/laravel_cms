<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Carbon\Carbon;

class User extends Authenticatable
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'is_active', 'photo_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role() {
        return $this->belongsTo('App\Role');
    }

    public function photo() {
        return $this->belongsTo('App\Photo');
    }

    public function getCreatedAtAttribute($value) {
        $carbonDate = new Carbon($value);
        return $carbonDate->diffForHumans();
    }

    public function getUpdatedAtAttribute($value) {
        $carbonDate = new Carbon($value);
        return $carbonDate->diffForHumans();
    }

    public function getIsActiveAttribute($value) {
        if((int) $value == 1) {
            return '<span class="alert alert-sm alert-success">Active</span>';
        }

        return '<span class="alert alert-sm alert-danger">Inactive</span>';
    }

    
}
