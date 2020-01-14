<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected  $tble='house';
    protected  $primaryKey='h_id';
    //public $timestamps='false';
    //黑名单
    protected  $guarded=[];
    public $timestamps = false;
}
