<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected  $tble='member';
    protected  $primaryKey='m_id';
    //public $timestamps='false';
    //黑名单
    protected  $guarded=[];
    public $timestamps = false;
}
