<?php
/**
 *分成额，支付
 *
 */

class CountModel{
    protected static $mysql;
    protected static $_mysql;
    protected static $mysql_;
    /**
     *mysql connect
     *
     *return resouce
     */
    public static function mysql(){
        if(!self::$mysql){
            self::$mysql = CD::mysql('game');
        }
        
        return self::$mysql;
    
    }
    public static function _mysql(){
        if(!self::$_mysql){
            self::$_mysql = CD::mysql('game');
        }
        
        return self::$_mysql;
    
    }

     public static function mysql_(){
        if(!self::$mysql_){
            self::$mysql_ = CD::mysql('game');
        }
        
        return self::$mysql_;
    
    }

    /**
     *
     *
     */
    public static function instance(){
    	self::seperateAcccount();
    }

    

    /**
     *b本月支付，总支付
     *
     *reuturn float
     */
    public static function cur_payment(){
    	$con = self::mysql();
    	$lastMonth = date('Ym',strtotime('-1 month')); //last month
    	$sql = "select  payment_id,sum(order_amount) as amount from order_info where pay_status=2 and '{$lastMonth}'=date_format(pay_time,'%Y%m') group by payment_id";
    	$con->query($sql);

        while($data = $con->fetch()){
            $_con = self::_mysql();

    		$sql = "select pay_amount_cur_month as amount_month,pay_amount as amount from payment where id='{$data['payment_id']}' ";
            $_con->query($sql);
            
            $result = $_con->fetch();
            //Y::dump($data['amount']);
            $total_account = $result['amount']+$data['amount'];  //zong zhifu
    		if(!empty($result)){
    			$sql = "update payment set pay_amount_cur_month='{$data['amount']}',pay_amount='{$total_account}' where id='{$data['payment_id']}'";
    		}else{
    			$sql="insert into payment(id,pay_amount_cur_month,pay_amount) values('{$data['payment_id']}','{$data['amount']}','{$data['amount']}')";
            }

    		$_con->query($sql);
    	}


    }

   

    
    /**
     *每个渠道的分成（总）
     *
     *return float
     */
    public static function seperateAcccount(){
        //ben yue chong zhi  zong chongzhi  zong fen cheng ge
        $lastMonth = date('Ym',strtotime('-1 month')); //last month
        $con  = self::mysql();
        $sql  = "select o.cooperation_id as cid,o.cooperation_name,o.payment_id,p.rate,sum(o.order_amount) as total from order_info as o,payment as p where o.pay_status=2 and o.payment_id=p.id and date_format(pay_time,'%Y%m')=$lastMonth group by cooperation_id";
        $con->query($sql);
        while($data = $con->fetch()){
            $conn = self::mysql_();
           
            $amount_month = $data['total']; //本月支付
            $payment = $data['total']*$data['rate'];//渠道对应支付方式的分成额 余下在分成给渠道
            
            $sq   = "select rate from cooperation where id='{$data['cid']}'";
            $conn->query($sq);
            $re = $conn->fetch();
            $rate    = $re['rate']; //渠道分成比例
            if(!empty($rate)){
                $_con   = self::_mysql();
                $sql    = "select pay_amount_cur_month as amount_month,pay_amount as amount,balance from cooperation where id='{$data['cid']}' ";
                $result = $_con->query($sql)->fetch();

                $amount_total = floatval($result['amount']+$amount_month);//总支付

                $seperate     = floatval(($data['total']-$payment)*$rate);    //本月分成额
                $seperate_total        = floatval($result['balance']+$seperate);//总分成额
                if(!empty($result)){
                    $sql ="update cooperation set pay_amount_cur_month={$amount_month} ,pay_amount={$amount_total},balance={$seperate_total} where id='{$data['cid']}'";

                }else{  
                    $sql="insert into cooperation(id,pay_amount_cur_month,pay_amount,balance) values('{$data['cid']}','{$amount_month}','{$amount_total}','{$seperate_total}')";
                }
               
                $_con->query($sql);

            }

            
            
        }
 
    }




}
?>
