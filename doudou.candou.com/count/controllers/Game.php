<?php
/**
 * Created by Hunter_wyg.
 * User: Administrator
 * Date: 2013-04-09
 * Time: 下午16:41
 */
class GameController extends Y_C
{


    /**
     * 接口测试 
     */
    function indexAction(){
        Y::disableView();
        Y::registerPlugin('ProtoBuf');

        // NetWorkModel::updateDict();
        //返回对应的protobuf对象,
        $queryObj =  get_body_by_route('manage.room_list_levels');

        //设置对象属性
        //$queyrObj->set_filedname(value);

        //将对象作为参数传递给 NetWorkModel 执行query 查询操作,该操作返回值为数组.
        $response = NetWorkModel::query($queryObj);  

        echo "<pre>";
        var_dump($response);

        // $this->redirect('roomlist');
    }
    /**
     * 列表页 分页
     */  
    function roomListAction(){        
        // $curPage = Y::get('page');
        $curPage=V_get::getRequer("page"); 
        // $count = RoomModel::countUser();
        $count =1001;
        $page = new V_page($count,25,$curPage);
        $limit = $page->getLimit();
        $paginator = $page->fpage(0);        
        // $userArr = RoomModel::roomList($limit);
        // $this->assign('data',$userArr);        
        $this->assign('paginator',$paginator);

    }

    function roomAttrAction(){
        $attrList = GameModel::roomAttrList();
        $this->assign('attrList',$attrList);
    }
    function roomAddAction(){ 
        header('content-type:text/html;charset=utf-8');
        // $data = Y_C::verify();

        $data=Y::request()->getPost();
        if($data['room_level_code']){
            if(GameModel::roomAdd($data)==='true'){
                // echo "<script type='text/javascript' language='javascript'>alert('房间等级添加成功');</script>";
                $this->redirect('roomattr');
            }

        }    
    }
    function roomEditAction(){
        $id = Y::request()->getParams('id');
        extract($id);
        $id = $id + 0;

        $orgData = GameModel::getOneRow('id= '.$id);
        $this->assign('orgData',$orgData[0]);

    }

    function doRoomEditAction(){
        Y::disableView();
        $data=Y::request()->getPost();

        if(!$t = GameModel::roomEdit($data)>0){
            // echo "<script type='text/javascript' language='javascript'>alert('房间等级添加成功');</script>";
            $this->redirect('roomattr');
        }else{
            Y::throwException();
        }

    }

    function roomDelAction(){
        Y::disableView();
        $id =Y::request()->getParams('id');
        extract($id);
        GameModel::roomDel($id);
        $this->redirect('/game/roomattr');
    }

    function userLevelListAction(){

        $data=GameModel::userlevellist();
        $this->assign('data',$data);
    }
    function userLevelAddAction(){
        Y::disableView();
        $data = Y::request()->getPost();
        $binds['level']=$data['level'];
        $binds['min_exp']=$data['min_exp'];
        $binds['level_name']=$data['level_name'];

        if($t = GameModel::userLevelAdd($binds)>0){
            //添加正常时 执行
            $this->redirect('/game/userlevellist');
        }else{
            //添加出错时 执行
            $this->redirect('/game/userlevellist');
        }

    }

    function userLevelEditAction(){
        Y::disableView();
        $data['level'] = Y::request()->getPost('level');
        $data['min_exp'] = Y::request()->getPost('min_exp');
        $data['level_name'] = Y::request() -> getPost('level_name');

        if( GameModel::userleveledit($data)>0 ){
            // GameModel::getOneRow('level='.$data['level']);
        }
    }
    function userLevelDelAction(){
        Y::disableView();
        $id = Y::request()->getPost('level');
        GameModel::userleveldel('level='.$id);
    }

     function learningAction(){
        Y::disableView();
        GameModel::test();
        echo "<pre>";

        print_r($this);
        echo "</pre>";

     }
       
}
