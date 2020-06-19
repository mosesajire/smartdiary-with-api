<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $fillable = ['body'];

     // Establish relationship between user model and entry model
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
