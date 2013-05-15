<?php
/**
 * Created by xiaomingji@candou.com .
 * User: Administrator
 * Date: 12-11-12
 * Time: 下午2:25
 * To change this template use File | Settings | File Templates.
 */
class FinanceController extends V_game
{


    /**
     * 订单页面
     *
     */
    function orderAction() {

        $time = array(
            'order_sn'  => $this->V( 'orderid' ),
            'user_id'   => $this->V( 'userid' ),
            'nickname'  => $this->V( 'username' )
        );

        $count = FinanceModel::getTotal( $time );
        $npage = $this->V( "page" );
        $page  = new V_page( $count, 15, $npage );
        $limit = $page->getLimit();
        $fpage = $page->fpage( 0 );
        $list  = FinanceModel::getList( $time, $limit );
        $this->assign( 'list', $list );
        $this->assign( 'fpage', $fpage );
        $this->assign('time',$time);
    }

    /**
     * 按渠道汇总页面
     *
     */
    function qudaoAction() {
        $time=array(
            'startTime'     => $this->V( 'startTime' )?$this->V( 'startTime' ):'',
            'endTime'       => $this->V( 'endTime' )?$this->V( 'endTime' ):'',
            //'cooperation'   => $this->V( 'cooperation' )?$this->V('cooperation'):'',
        );

        $count = FinanceModel::byCooperCount( $time );
        $npage = $this->V( "page" );
        $page  = new V_page( $count, 15, $npage );

        $limit = $page->getLimit();
        $fpage = $page->fpage( 0 );
        $list  = FinanceModel::byCooperation( $time, $limit );
        $this->assign( 'list', $list );

        $this->assign( 'fpage', $fpage );
        $this->assign('time',$time);

    }

    function payAction() {
        $time=array(
            'startTime'     => $this->V( 'startTime' )?$this->V( 'startTime' ):'',
            'endTime'       => $this->V( 'endTime' )?$this->V( 'endTime' ):'',
        );
        $count = FinanceModel::byPayCount($time);
        $npage = $this->V( "page" );
        $page  = new V_page( $count, 15, $npage );

        $limit = $page->getLimit();
        $fpage = $page->fpage( 0 );
        $list  = FinanceModel::byPayment( $time, $limit );
        $this->assign( 'list', $list );

        $this->assign('time',$time);
        $this->assign( 'fpage', $fpage );

    }


    /**
     *按时间汇总 时间区间搜索(默认本月1号至今)，显示全部，渠道搜索
     *
     */
    function dateAction() {
        $time=array(
            'startTime'     => $this->V( 'startTime' )?$this->V( 'startTime' ):date('Y-m-1',time()),
            'endTime'       => $this->V( 'endTime' )?$this->V( 'endTime' ):date('Y-m-d',time()),
            'cooperation_id'=>$this->V('cooperation_id')?$this->V('cooperation_id'):'',
            'payment_id'    =>$this->V('payment_id')?$this->V('payment_id'):''
        );
        $option= FinanceModel::option(); 
        $count = FinanceModel::byTimeCount( $time );
        $npage = $this->V( "page" );
        $page  = new V_page( $count, 15, $npage );
        $limit = $page->getLimit();
        $fpage = $page->fpage( 0 );
        $list  = FinanceModel::byTime( $time, $limit );
        $this->assign( 'list', $list );
        $this->assign('time',$time);
        $this->assign( 'fpage', $fpage );
        $this->assign('option',$option);

    }




}
