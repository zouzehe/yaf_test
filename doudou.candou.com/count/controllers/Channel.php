<?php
/**
 * Created by xiaomingji@candou.com .
 * User: Administrator
 * Date: 12-11-12
 * Time: 下午2:25
 * 渠道管理.
 */
class ChannelController extends V_game{

    //cooperation list
    function partnerAction(){
        $count = ChannelModel::getTotal('cooperation');
        $npage = $this->V( "page" );
        $page  = new V_page( $count, 15, $npage );
        $limit = $page->getLimit();
        $fpage = $page->fpage( 0 );
        $list  = ChannelModel::partnerList($limit);
        $this->assign( 'list', $list );
        $this->assign( 'fpage', $fpage );
    
    }
    
    //数据插入；新增支付方式，渠道，平台
    function newitemAction(){
        Y::disableView();
        $post   = $_POST;
        $table  = ($this->V('action'));
        if($table=="cooperation"&&empty($post['can_login'])){
            $post['can_login']=0;
        }   
        $flag = ChannelModel::itemAdd($table,$post);
        if($flag){
            switch($table){
            case 'cooperation':
                header("Location:/channel/partner");
                break;
            case 'platform':
                header("Location:/channel/platform");
                break;
            case 'payment': 
                header("Location:/channel/pay");
                break;
            default:
                false;
                break;
            }
        }
    }

    function edititemAction(){
        Y::disableView();
        $post   = $_POST;
        $table  = ($this->V('action'));
        if($table=='cooperation'&&empty($post['can_login'])){
            $post['can_login']=0;
        }
        $flag = ChannelModel::itemedit($table,$post);
        if($flag){
            switch($table){
            case 'cooperation':
                header("Location:/channel/partner");
                break;
            case 'platform':
                header("Location:/channel/platform");
                break;
            case 'payment': 
                header("Location:/channel/pay");
                break;
            default:
                false;
                break;
            }
        }
    }
    
    
    //账号平台页面
    function platformAction(){
        $count = ChannelModel::getTotal('platform');
        $npage = $this->V( "page" );
        $page  = new V_page( $count, 15, $npage );
        $limit = $page->getLimit();
        $fpage = $page->fpage( 0 );
        $list  = ChannelModel::platformList($limit);
        $this->assign( 'list', $list );
        $this->assign( 'fpage', $fpage );

    }

    //支付平台页面
    function payAction(){
        $count = ChannelModel::getTotal('payment');
        $npage = $this->V( "page" );
        $page  = new V_page( $count, 15, $npage );
        $limit = $page->getLimit();
        $fpage = $page->fpage( 0 );
        $list  = ChannelModel::payList($limit);
        $this->assign( 'list', $list );
        $this->assign( 'fpage', $fpage );

    }

    //合作渠道修改页面
    function partnereditAction(){
        $id    = $this->V('number');
        $data  = ChannelModel::getContent($id,'cooperation');
        $this->assign('data',$data);
    }
    
    //账号平台修改页面
    function platformeditAction(){
        $id    = $this->V('number');
        $data  = ChannelModel::getContent($id,'platform');
        $this->assign('data',$data);

    }
    
    //支付方式修改页面
    function payeditAction(){
        $id    = $this->V('number');
        $data  = ChannelModel::getContent($id,'payment');
        $this->assign('data',$data);

    }
    
    //page of new cooperation
    function partneraddAction(){

    }


    function platformaddAction(){
        //echo 'add platform';

    }

    function payaddAction(){


    }
}







?>
