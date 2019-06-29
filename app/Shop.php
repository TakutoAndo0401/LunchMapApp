<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{

    protected $fillable = ['name' , 'address' , 'body' , 'image' ];

    //shopsテーブルのuser_idとusersテーブルのidを紐づける。
    public function user(){
        return $this->belongsTo('App\User');
    }
}
