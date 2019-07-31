<?php
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 2019/7/29
 * Time: 1:15 PM
 */

namespace App\Http\Controllers\Api;


use App\Libs\Util;

class UploadFileController extends ApiController{
    public function uploadFile(){
        $resp = ['msg'=>'ok', 'code'=>200, 'url'=>''];
        $file = isset($_FILES['image']) ? @$_FILES['image'] : @$_FILES['file'];
        if (!empty($file) && $file['name'] && $file['error'] == 0 && (isset($GLOBALS['upload_mime'][$file['type']]))) {
            $path = '/images/'.date('Ymd')."/";
            $url = $path. Util::getUploadImageName() .'.'.pathinfo($file['name'])['extension'];
            if (!is_dir(RESOURCEPATH.$path)){
                if(!mkdir(RESOURCEPATH.$path, 0777)){
                    $resp['msg'] = '目录创建失败';
                    $resp['code'] = 210;
                    return $this->json($resp,$resp['msg'], $resp['code']);
                }
            };
            if (!move_uploaded_file($file['tmp_name'], RESOURCEPATH.$url))  return 0;
            //return  response()->json(['url'=> UPLOADS."/Uploads".$url,'code'=>0]);
            $resp['url'] = UPLOADS."/Uploads".$url;
            return $this->json($resp,$resp['msg'], $resp['code']);
        }
        $resp['msg'] = '图片上传失败';
        $resp['code'] = 210;
        return $this->json($resp,$resp['msg'], $resp['code']);
    }
}