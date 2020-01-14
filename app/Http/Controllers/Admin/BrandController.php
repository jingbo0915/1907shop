<?php

namespace App\Http\Controllers\Admin;
use Validator;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;
use App\Mail\SendCode;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
class BrandController extends Controller
{

    public function sendemail()
    {
        Mail::to('1399442426@qq.com')->send(new SendCode());
    }





    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        //cache 门面 use Illuminate\Support\Facades\Cache;
//        Cache::put('key', 'value', $seconds); //存储
//        Cache::get('key'); //获取
//        Cache::forget('key');//删除
//        //全局辅助函数
//        cache(['key' => 'value'], $seconds);//存储
//        $value = cache('key');//获取
        $word=request()->word??'';
        $desc =request()->desc??'';
        $page =request()->page;
            //echo $page;
       // $data =cache('data_'.$page.'_'. $word.'_'.$desc);
        $data =redis::get('data_'.$page.'_'. $word.'_'.$desc);
        //dump($data);

        if(!$data){
                echo "走db";
//        $data = DB::table('brand')->get();
//        return view('admin.brand.index',['data'=>$data]);

            $where=[];
            if($word){
                $where[]=['brand_name','like',"%$word%"];
            }
            if($desc){
                $where[]=['brand_desc','like',"%$desc%"];
            }



            $data = Brand::where($where)->orderBy('brand_id', 'desc')->paginate(4);
           // cache(['data_'.$page.'_'. $word.'_'.$desc.$page=>$data],60*2);
            $data = serialize($data);
           Redis::setex('data_'.$page.'_'. $word.'_'.$desc,20,$data);
        }
            $data =unserialize($data);

          $query=request()->all();
        if(request()->ajax()){
            return view('admin.brand.ajaxindex',['data' => $data,'query'=>$query]);
        }
        return view('admin.brand.index', ['data' => $data,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $post=$request->all();
//        $post = $request->except('_token');
//
//        $res =DB::table('brand')->insert($post);
//        if($res){
//            return redirect('/brand');
//        }


        $validator = Validator::make($post,[
            'brand_name' => 'required|unique:brand|max:255',
            'brand_url' => 'required',
            'brand_desc' => 'required',
        ],[
            'brand_name.required'=>'品牌名称必填!',
            'brand_name.unique'=>'品牌名称已存在!',
            'brand_url.required'=>'品牌网址必填!',
            'brand_desc.required'=>'品牌介绍必填!',
        ]);
        if ($validator->fails()) { return redirect('brand/create')
            ->withErrors($validator)
            ->withInput();
        }

        //第一种
//        $validatedData = $request->validate([
//            'brand_name' => 'required|unique:brand|max:255',
//            'brand_url' => 'required',
//            'brand_desc' => 'required',
//
//        ],[
//            'brand_name.required'=>'品牌名称必填!',
//            'brand_name.unique'=>'品牌名称已存在!',
//            'brand_url.required'=>'品牌网址必填!',
//            'brand_desc.required'=>'品牌介绍必填!',
//        ]);
        if($request->hasFile('brand_logo')){
            $post['brand_logo'] = upload('brand_logo');
        }

//        $brand = new Brand();
//        $brand->brand_name=$post['brand_name'];
//        $brand->brand_url=$post['brand_url'];
//        $brand->brand_logo=$post['brand_logo']??'';
//        $brand->brand_desc=$post['brand_desc'];
//        $res=$brand->save();
        $data = Brand::create($post);

        if ($data) {
            echo "<script>alert('添加成功');location.href='/brand';</script>";
        }

        dd($post);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Brand::where('brand_id', $id)->first();
        return view('admin.brand.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token');
//        dd($data);
        if($request->hasFile('brand_logo')){
            $data['brand_logo'] =('brand_logo');
        }
//        dd($data);
        $res = Brand::where('brand_id', $id)->update($data);
        if ($res == 1) {
            echo "<script>alert('修改成功');location.href='/brand';</script>";
        } else if ($res == 0) {
            echo "<script>alert('修改无变化');location.href='/brand';</script>";
        } else {
            echo "<script>alert('修改失败');location.href='/brand/edit';</script>";
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Brand::where('brand_id', $id)->delete();
        if ($res) {
//            return rediretc('/brand');
            echo "<script>alert('删除成功');location.href='/brand';</script>";
        }
    }


}
