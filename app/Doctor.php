<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = ['name','reg','photo','education','is_active','user_id'];

    
    //getting active customers using scope
    function scopeIs_active($query){
    	return $query->where('is_active',1);
    }
    
}
