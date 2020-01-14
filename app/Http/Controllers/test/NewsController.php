<?php

namespace App\Http\Controllers\test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class NewsController extends Controller
{
    /**
     *展示
     */
    public function index()
    {
        $word =request()->n_title??'';
        $n_content =request()->n_content??'';
        $page =request()->page;
        $data =cache('data_'.$word.'_'.  $n_content.'_'.$page);
        if(!$data){
            echo "走db";
            $where= [];
            if($word){
                $where[]=['n_title','like',"%$word%"];
            }
            if($n_content){
                $where[]=['n_content','like',"%$n_content%"];
            }
            $data = DB::table('news')->where($where)->orderBy('n_id','desc')->paginate(2);
            cache(['data_'.$word.'_'.  $n_content.'_'. $page=>$data],60*2);

        }

        $query =request()->all();
       // dd($query);
       // $data =DB::table('news')->get();

            if(request()->ajax()){
                return view('test.news.ajaxindex',['data'=>$data,'query'=>$query]);
            }
        return view('test.news.index',['data'=>$data,'query'=>$query]);
    }

    /**
     *添加
     */
    public function create()
    {

        return view('test.news.create');
        
    }


   /**添加的执行页面*/
    public function store(Request $request)
    {
         //接收值
        $post= $request->except('_token');
        //dump($post);        //有没有进行文件上传
      if($request->hasFile('n_myfile')){
          $post['n_myfile']= $this->upload('n_myfile');
      }
        //dd($post);
        $res =DB::table('news')->insert($post);
        if($res){
            return redirect('/news');
        }
        exit('没有文件上传，或者文件上传有误');
    }

    //上传图片
    public function upload($filename){
        //判断文件上传是否成功
        if( request()->file($filename)->isValid() ){
            //接收文件
            $photo  =request()->file($filename);
            //上传文件
            $store_result = $photo->store('news');
            return $store_result;
        }
    }
    //编辑
    public function edit($id)
    {
        $data =DB::table('news')->where('n_id',$id)->first();
        return view('test.news.edit',['data'=>$data]);
    }


    public function update(Request $request, $id)
    {
        $post =$request->except('_token');
       $res =DB::table('news')->where('n_id',$id)->update( $post);
       if($res!==false){
           return redirect('/news');
       }
    }


    public function destroy($id)
    {
          $res = DB::table('news')->where('n_id',$id)->delete();
        if($res){
            return redirect('/news');
        }
    }
}
