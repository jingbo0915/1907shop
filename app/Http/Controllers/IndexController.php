<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function goods($goods_id){

       echo 'id是：'.$goods_id;
    }
    public function  getgoods($goods_id,$goods_name='iphone'){
        echo 'id是：'.$goods_id;
        echo '名称是：'.$goods_name;
    }
}
