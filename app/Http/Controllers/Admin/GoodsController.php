<?php

namespace App\Http\Controllers\admin;
use App\Brand;
use App\Category;
use App\Goods;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redis;
class GoodsController extends Controller
{


    public function index()
    {

        //全局辅助函数获取分页

        $word=request()->word??'';
        $desc =request()->desc??'';
        $page =request()->page;
        $pageSize =config('app.pageSize');
        $data =redis::get('data_'.$page.'_'. $word.'_'.$desc);
       // dd( $pageSize);
        if(!$data){
            echo "走DB";
                $where=[];
                if($word){
                    $where[]=['goods_name','like',"%$word%"];
                }
                if($desc){
                    $where[]=['brand_name','like',"%$desc%"];
                }
                $data  =Goods::select('goods.*','brand.brand_name','category.cate_name')
                    ->leftjoin('brand','goods.brand_id','=','brand.brand_id')
                    ->leftjoin('category','goods.cate_id','=','category.cate_id')
                    ->where($where)
                    ->orderBy('goods_id','desc')
                    ->paginate($pageSize);

                //dd($data);
                foreach($data as $v){
                    if($v->goods_imgs){
                        $v->goods_imgs = explode('|',$v->goods_imgs);
                    }
                }
                 $data = serialize($data);
                Redis::setex('data_'.$page.'_'. $word.'_'.$desc,20,$data);
        }
        $data =unserialize($data);
        $query=request()->all();
        //dd($data);
        if(request()->ajax()){
            return view('admin.goods.ajaxindex',['data' => $data,'query'=>$query]);
        }
            return view('admin.goods.index',['data' => $data,'query'=>$query]);
    }


    public function create()
    {
        Cookie::queue('test','adfa',1);
       // echo  Cookie::get('test');die;
        //获取品牌数据
        $brand = Brand::get();
        //获取分类的所有数据
        $category = Category::get();
        $category=createTree(  $category);
      // dd( $category);
        return view('admin.goods.create',['brand'=>$brand],['category'=>$category]);
    }


    public function store(Request $request)
    {
        $post= $request->except('_token');
       // dd($post);
        //单个文件上传
        if($request->hasFile('goods_img')){
            $post['goods_img'] =upload('goods_img');
        }
       //多文件上传
            //isset判断这个变量有没有
        if(isset($post['goods_imgs'])){
            $post['goods_imgs']= moreuploads('goods_imgs');
            //将多图片转为字符串
            $post['goods_imgs'] = implode('|',$post['goods_imgs']);
        }
        $post['add_time']=time();
        $post['update_time']=time();

        $res=Goods::insert($post);
      if($res){
          return redirect('/goods');
      }
    }


    public function show($id)
    {
        //访问量
        $res =Redis::setnx('show_'.$id,1);
        if(!$res){
        Redis::incr('show_'.$id);
    }
       $current=Redis::get('show_'.$id);
        //根据id找到商品信息
        $goods = Goods:: find($id);
       return view('admin.goods.show',['goods'=>$goods,'current'=>$current]);
    }


    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    //添加购物车
            public function addcart()
            {
                $goods_id =request()->goods_id;
              //  dd($goods_id);
                $buy_number = 1;
                //echo $goods_id;die;
                //判断用户是否登录
                if(!$this->isLogin()){
//                        echo json_encode(['code'=>'00001','msg'=>'未登录，请先登录']);die;
//                        //未登录存入cookie
               }
                        //登路存入db
                    $this->addDBcart($goods_id,$buy_number);
            }
            public function addDBcart($goods_id,$buy_number){

                //求商品信息
                $goodsInfo =Goods::where('goods_id',$goods_id)->first();
                //判断库存
                    if($goodsInfo->buy_number<$buy_number){
                        echo json_encode(['code'=>'00002','msg'=>'库存不足']);die;
                    }
                $user_id =session('admin')->u_id;
                //判断用户是否之前购买过
                  $cart = DB::table('cart')->where(['goods_id'=>$goods_id,'user_id'=>$user_id])->first();
                  if($cart){

                      //如果$cart有值 更新购买数量
                      //更行库存
                          if($cart->buy_number+$buy_number>$goodsInfo->buy_number){
                              echo json_encode(['code'=>'00002','msg'=>'库存不足']);die;
                          }
                    $res =  DB::table('cart')->where(['goods_id'=>$goods_id,'user_id'=>$user_id])->increment('buy_number');
                     if($res){
                         echo   json_encode(['code'=>'00000','msg'=>'添加成功']);die;
                     }
                  }
                //没有购买过 正常添加数据
                //求价格
               $goods_price= Goods::where('goods_id',$goods_id)->value('goods_price');
               // dd($goods_price);
                    $data =[
                            'user_id'=> $user_id,
                            'goods_id'=>$goods_id,
                            'buy_number'=>1,
                            'goods_price'=>$goodsInfo->goods_price,
                            'addtime'=>time()

                    ];
               $res =DB::table('cart')->insert($data);

               if($res){
                 echo   json_encode(['code'=>'00000','msg'=>'添加成功']);die;
               }
            }
    //判断用户是否登录
    public function isLogin(){
        $user = session('admin');
        if(!$user){
            return false;
        }
        return true;
    }
}
