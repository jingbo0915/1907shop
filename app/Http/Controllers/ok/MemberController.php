<?php

namespace App\Http\Controllers\ok;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Member;
class MemberController extends Controller
{
    //展示页面
    public function index()
    {


        $word = empty(request()->word)?'':request()->word;
        $where=[];
        if($word){
            $where[]=['m_cate','like',"%$word%"];
        }
        $desc = empty(request()->desc)?'':request()->desc;
        if( $desc){
            $where[]=['m_title','like',"%$desc%"];
        }

        // $data =DB::table('member')->where($where)->orderBy('m_id','desc')->paginate(2);
        $data =DB::table('member')->orderBy('m_id','desc')->paginate(2);

       //return  view('ok.member.index',['data'=>$data]);

        $query = request()->all();
        //判断是不是ajax
        if(request()->ajax()){
            return view('ok.house.ajaxindex',['data'=>$data,'query'=>$query]);
        }


        // $data=Brand::orderBy('brand_id','desc')->paginate(2);
        //$logs = DB::getQueryLog();
        //dd($logs);


        return view('ok.member.index',['data'=>$data,'query'=>$query]);

    }

    //添加展示页面
    public function create()
    {
        return view('ok.member.create');
    }
    //执行添加页面
    public function store(Request $request)
    {
        $post = $request->except('_token');
            dd($post);
        if(request()->hasFile('m_file')){
            $post['m_file']=$this->upload('m_file');
        }
       $res = DB::table('member')->insert($post);
        //dd( $res);
        if($res){
            return redirect('/member');
        }
    }

//上传图品
    public function upload($filename){
        if ( request()->file($filename)->isValid()) {
            //接收文件
            $photo = request()->file($filename);
            //上传文件
            $store_result = $photo->store('uploads');
            return  $store_result;
        }
        exit('没有文件上传，文件上传有误');

    }



    public function destroy($id)
    {
        $res =DB::table('member')->where('m_id',$id)->delete();
        if($res){
            if(request()->ajax()){
                echo json_encode(['code'=>'00000','msg'=>'删除成功']);die;
            }
            return  redirect('/member');
        }
//        $res =DB::table('member')->where('m_id',$id)->delete();
//        if($res){
//            return redirect('/member');
//        }
    }
}
