<?php
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 2019/7/19
 * Time: 10:10 AM
 */

namespace App\Http\Controllers\Api;


use App\Models\Model;

class MemberController extends ApiController{
    // 用户分享页面
    public function share(){
        $uid = $this->uid;
        $url = $this->req('url', '');
        $data = [];
        $data['member_id'] = $uid;
        $data['share_url'] = $url;
        if (Model::Food()->insertMemberShare($data)){
            return $this->json([],'分享成功');
        }
        return $this->error('分享失败', 201);
    }
}