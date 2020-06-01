<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public $timestamps = false;


    protected $fillable = [
        'name', 'description', 'logo',
    ];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
