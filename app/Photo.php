<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public static $photo_dir = '/images/';
    
    protected $fillable = ['file'];

    public function user() {
        return $this->hasOne('App\User');
    }

    public function getFileAttribute($value) {
        
        return static::$photo_dir . $value;
    }

}
