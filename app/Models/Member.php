<?php
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 2019/7/25
 * Time: 10:58 AM
 */

namespace App\Models;


use App\Libs\Util;

class Member extends Model{
    public function getOauthMemberBindByOpenId($openId=''){
        return self::table('oauth_member_bind')->where(['openid'=>$openId])->first();
    }
    public function insertOauthMemberBind($data){
        return self::table('oauth_member_bind')->insertGetId($data);
    }
    public function getOauthMemberBindByMemberId($member_id){
        return self::table('oauth_member_bind')->where(['member_id'=>$member_id])->first();
    }
    public function getMemberById($id=0){
        return self::table('member')->where(['id'=>$id])->first();
    }
    public function insertMember($data){
        return self::table('member')->insertGetId($data);
    }
    public function updatePayOrderByOrderSn($order_sn, $data=[]){
        return self::table('pay_order')->where(['order_sn'=>$order_sn])->update($data);
    }
    //判断用户是否注册或已经注册,返回注册用户信息
    public function checkMemberOrUpdateMember($member=[], $openid=''){
        //检查用户是否注册
        $bind_info = $this->getOauthMemberBindByOpenId($openid);
        if (!empty($bind_info)){
            return $this->getMemberById($bind_info->member_id);
        }
        $resp = [];
        try{
            self::beginTransaction();
            $member['salt'] = Util::getSalt();
            $member['updated_time'] = $member['created_time'] = DATETIME;
            $member_id = $this->insertMember($member);
            $insertOauthMemberBind = [];
            $insertOauthMemberBind['member_id'] = $member_id;
            $insertOauthMemberBind['client_type'] = 'weixin';
            $insertOauthMemberBind['type'] = 1;
            $insertOauthMemberBind['openid'] = $openid;
            $insertOauthMemberBind['unionid'] = '';
            $insertOauthMemberBind['extra'] = '';
            $insertOauthMemberBind['updated_time'] = $insertOauthMemberBind['created_time'] = DATETIME;
            $this->insertOauthMemberBind($insertOauthMemberBind);
            $resp = $this->getMemberById($member_id);
            self::commit();
        }catch (\Exception  $e){
            $resp = [];
            self::rollBack();
        }
        return $resp;
    }
}