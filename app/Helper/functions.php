<?php
/**
 * 公用的方法  返回json数据，进行信息的提示
 * @param $status 状态
 * @param string $message 提示信息
 * @param array $data 返回数据
 */
function showMsg($status,$message = '',$data = array()){
    $result = array(
        'status' => $status,
        'message' =>$message,
        'data' =>$data
    );
    exit(json_encode($result));
}
    function createTree($data,$parent_id=0,$lever=0){

        static $new_array=[];
        if(!$data){
            return ;
        }
        foreach($data as $k=>$v){
            if($v->parent_id==$parent_id){
                $v->level = $lever;
                $new_array[] =$v;
                createTree($data,$v->cate_id,$lever+1);
            }
        }
        return $new_array;
    }

       //单个文件上传

//单个文件上传
//单个文件上传
 function upload($brand_logo)
{
    if (request()->file($brand_logo)->isValid()) {
        $photo = request()->file($brand_logo);
        $store_result = $photo->store('uploads');
        return $store_result;
}
    exit('未获取到上传文件或上传过程出错');

}

        //多文件上传
        function  moreuploads($fielname){

            if(!$fielname) {
                return;
            }
           $imgs =request()->file($fielname);
            //dd($imgs);
            $result = [];
            foreach($imgs as $v){
               // $photo = request()->file($v);
                $result[] = $v->store('uploads');
            }
            return $result;
        }





?>