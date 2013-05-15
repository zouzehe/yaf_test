<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-11-12
 * Time: 下午2:25
 * To change this template use File | Settings | File Templates.
 */
class UserController extends V_game
{     
    /**
     * 用户列表   *
     */  
    function listAction(){ 
        $count = UserModel::countUser();
        $npage = $this->V("page");
        $page  = new V_page($count,10,$npage);
        $offset = $page->getOffset();
        $fpage = $page->fpage(0);        
        $userArr = UserModel::userList($offset);
        $this->assign('data',$userArr);        
        $this->assign('fpage',$fpage);
    }
    /**
     * 用户编辑   *
     */ 
    function editAction(){         
        $uid = $this->V('id');
        if(!$uid) exit();
        $user = UserModel::selectUserById($uid);
        $this->assign('data',$user);
        $this->assign('uid',$uid);
    }
    
    function saveAction(){
        Y::disableView();
        $data = array(
            'nickname'      => $this->V('nickname'),
            'uid'           => $this->V('userid'),
            'coins'         => $this->V('coins'),
            'chips'         => $this->V('chips'),
            'safebox_chips' => $this->V('safebox_chips'),
            'exp'           => $this->V('exp'),
            'can_speak'     => $this->V('can_speak'),
            'can_login'     => $this->V('can_login')
        );
        UserModel::setUser($data); 
    }

    /**
     * 按渠道汇总   *
     */
    function qudaoAction(){         
        $searchArr = array(
            "startTime" => $this->V("startTime"),
            "endTime"   => $this->V("endTime")                      
        ); 
        $userArr = UserModel::countUserByChannel($searchArr);
        $this->assign('term',$searchArr);
        $this->assign('data',$userArr);
    }
    /**
     * 按时间汇总   *
     */
    function dateAction(){                        
        $searchArr = array(
            "startTime"     => $this->V("startTime"),
            "endTime"       => $this->V("endTime"),
            "cooperation_id"=> $this->V("cooperation"),
            "platform_id"   => $this->V("platform")
        ); 
        $userArr = UserModel::countUserByDate($searchArr);         
        $cooperationArr = UserModel::cooperation();
        $platformArr = UserModel::platform();
        $this->assign('term',$searchArr);
        $this->assign('data',$userArr);
        $this->assign('cooperationList',$cooperationArr);
        $this->assign('platformList',$platformArr);
    }
   
    /**
     * 用户搜索   *
     */  
    function searchAction(){ 
        $searchArr = array(
            "startTime"     => $this->V("startTime"),
            "endTime"       => $this->V("endTime"),
            "cooperation_id"=> $this->V("cooperation"),
            "platform_id"   => $this->V("platform"),
            "vip_type"      => $this->V("vip_type"),
            "level"         => $this->V("level"),
            "client"        => $this->V("client"),
            "can_speak"     => $this->V("can_speak"),
            "sort"          => $this->V("sort")
        );         
        $count = UserModel::countUser($searchArr);
        $cooperationArr = UserModel::cooperation();
        $platformArr = UserModel::platform();
        $npage = $this->V("page");
        $page  = new V_page($count,10,$npage);
        $limit = $page->getLimit();
        $fpage = $page->fpage(0);        
        $userArr = UserModel::search($searchArr,$limit);
        $this->assign('term',$searchArr);
        $this->assign('data',$userArr);        
        $this->assign('fpage',$fpage);
        $this->assign('cooperationList',$cooperationArr);
        $this->assign('platformList',$platformArr);
    }
    /**
     * VIP类型 
     */ 
    function vipAction(){
        $id = $this->V("id");
        $vipList = UserModel::selectVipById($id);
        $this->assign('vip',$vipList);
        $this->assign('uid',$id);
    }
    /**
     * 邮件列表 
     */
    function emailAction(){
        $id = $this->V("id");
        $emailList = UserModel::selectEmailById($id);
        $this->assign('email',$emailList);
        $this->assign('uid',$id);
    }  
    /**
     * 踢人 
     */  
    function kickAction(){
        $uid = $this->V('id');
        $this->assign('uid',$uid);
        
    }
    /**
     * 踢人保存 
     */
    function kicksaveAction(){
        Y::disableView();
        $kickArr = array(
            "uid" => $this->V('userid'),
            "type" => $this->V('type'),
            "reason" => $this->V('reason'),
            "expire" => $this->V('expire'),   
        );
        $rst = UserModel::kick($kickArr);
        if($rst) $this->redirect("/user/kick/id/".$kickArr['uid']);
    }

    /**
     * 禁言 
     */
    function speakAction(){
        $id = $this->V("id");
        $this->assign('uid',$id);
    }
    /**
     * 禁言保存 
     */   
    function slientAction(){
        Y::disableView();
        $slientArr = array(
            "uid" => $this->V('userid'),
            "reason" => $this->V('reason'),
            "expire" => $this->V('expire'),   
        );
        $rst = UserModel::slient($slientArr);
        if($rst) $this->redirect("/user/speak/id/".$slientArr['uid']);
    }
    /**
     * VIP使用记录 
     */
    function viprecordAction(){
        $id = $this->V("id");
        $record = UserModel::records($id);    
        $this->assign('list',$record);    
        $this->assign('uid',$id);
    }
    /**
     * 好友列表 
     */
    function friendsAction(){
        $id = $this->V("id");
        $friends = UserModel::friends($id);    
        $this->assign('list',$friends);
        $this->assign('uid',$id);
    }
    /**
     * 道具列表 
     */
    function propertyAction(){
        $id = $this->V("id");
        $property = UserModel::property($id);
        $this->assign('list',$property); 
        $this->assign('uid',$id);
    }
       
}
