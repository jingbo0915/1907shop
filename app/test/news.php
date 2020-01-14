<?php

namespace App\test;

use Illuminate\Database\Eloquent\Model;

class news extends Model
{
    protected  $table='news';
    protected  $primaryKey='n_id';
    //public $timestamps='false';
    //黑名单
    protected  $guarded=[];
    public $timestamps = false;
}
