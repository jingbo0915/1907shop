<?php

namespace App\Http\Controllers\index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
   //����չʾҳ��
    public function create()
    {
       return view('index.book.create');
    }
}