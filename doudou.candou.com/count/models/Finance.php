<?php
/**
 * 财务管理model 订单
 *
 * @author xiaoming@candou.com
 * @package myproject
 */


class FinanceModel {



	public static $mysql='';
	/**
	 * 订单总数
	 *
	 * @param array   $arr 搜索条件
	 * @param unknown $arr
	 *return int
	 */
	public static function getTotal( $arr ) {
		$where = self::getWhere( $arr );
		if ( $where ) {
			$where='where '.$where;
		}else {
			$where='';
		}
		$con   = self::mysql( 'game' );
		$sql   = "select count(*) as t from order_info $where";
		$con->query( $sql );
		$count = $con->fetch();
		return $count['t'];

	}


	/**
	 * 获取查询条件
	 *
	 * @param array   $arr 查询条件数组
	 * return string
	 */
	public static function getWhere( $arr ) {
		if ( empty( $arr ) ) {
			return false;
		}
		$where= "";
		foreach ( $arr as $key=>$value ) {
			if ( !empty( $arr[$key] ) ) {

				$where .= "{$key}='{$value}' and ";
			}

		}
		$where = rtrim( $where, ' and ' );

		return $where;

	}


	/**
	 * 获取订单列表
	 *
	 * @param array   $arr   查询条件
	 * @param string  $limit limit条件
	 */
	public static function getList( $arr, $limit ) {
		$where = self::getWhere( $arr );
		if ( $where ) {
			$where='where '.$where;
		}else {
			$where='';
		}

		$con   = self::mysql( 'game' );
		$sql   = "select order_sn,user_id,nickname,pay_status,goods_name,goods_number,shop_price,order_amount,pay_status,payment_name,add_time,pay_time,cooperation_name from order_info $where order by pay_time desc $limit";
		$con->query( $sql );
		$data = $con->fetchAll();
		return $data;

	}

	/**
	 * 按渠道汇总列表
	 *
	 *@param array  $arr   搜索条件数组
	 *@param string $limit limit 条件
	 *return array
	 */
	public static function byCooperation( $arr, $limit ) {
		$where  = self::qudaoWhere($arr);  
	
		$con	= self::mysql('game');
		$sql    = "select  cooperation_id,cooperation_name,count(*) as t,sum(order_amount) as total from order_info $where group by cooperation_id $limit";
		$con->query($sql);
		$data   = $con->fetchAll();
		
		return $data;
	}

	/**
	 * 按支付方式 汇总
	 *
	 *@param array  $arr   搜索条件数组
	 *@param string $limit limit 条件
	 *return array
	 */
	public static function byPayment( $arr, $limit ) {
		$where  = self::qudaoWhere($arr);  
	
		$con	= self::mysql('game');
		$sql    = "select  payment_id,payment_name,count(*) as t,sum(order_amount) as total from order_info $where group by payment_id $limit";
		$con->query($sql);
		$data   = $con->fetchAll();
		
		return $data;
	}



	/**
	 *按时间汇总列表
	 *@param array   $arr  搜索条件
	 *@param string  $limit limit条件
	 *
	 */
	public static function byTime( $arr, $limit ) {
		$where = self::qudaoWhere($arr);
		
		$con   = self::mysql('game');
		$sql   = "select  pay_time,count(*) as t,sum(order_amount) as total  from order_info $where group by date(pay_time) $limit";
        //echo $sql;
		$con->query($sql);
		$data = $con->fetchAll();
		return $data;
	}

	/**
	 *渠道页搜索条件组合
	 *@param array $arr 条件
	 *return string
	 */
	public static function qudaoWhere($arr){
		$where = 'where pay_status=1';
		if(!empty($arr['startTime'])&&$arr['endTime']!=''){
				$where .= " and date(pay_time) between '{$arr['startTime']}' and '{$arr['endTime']}'";

		}
		if(!empty($arr['cooperation_id'])){
			$where.=" and cooperation_id='{$arr['cooperation_id']}'";
		}
		if(!empty($arr['payment_id'])){
			$where.=" and payment_id='{$arr['cooperation_id']}'";
		}
		return $where;

	}

	/**
	 *总数 默认全部所有
	 *
	 *@param array $arr 搜索条件
	 *return int
	 */
	public static function byCooperCount($arr){
		$where  = self::qudaoWhere($arr); 
		$con	= self::mysql('game');
		$sql    = "select  id from order_info $where group by cooperation_id";	
		$con->query($sql);
		$count  = $con->fetchAll();
		return count($count);
	}

	/**
	 *支付方式 统计
	 *@param array $arr 时间
	 *return int
	 */
	public static function byPayCount($arr){
		$where  = self::qudaoWhere($arr); 
		$con	= self::mysql('game');
		$sql    = "select  id from order_info $where group by payment_id";	

		$con->query($sql);
		$count  = $con->fetchAll();
		return count($count);
	}

	/**
	 *按时间汇总总数
	 *
	 *@param array $arr 搜索条件
	 *return int
	 */
	public static function byTimeCount($arr){
		$where = self::qudaoWhere($arr);
		$con   = self::mysql('game');
		$sql   = "select id from order_info $where group by DATE(pay_time)";
		$con->query($sql);
		$count = $con->fetchAll();
		return count($count);
	}

	/**
	 *按时间汇总 下拉框选项
	 *return array
	 */
    public static function option(){
        $data     = '';
        $con      = CD::mysql('game');
        $sql      = "select id,name from cooperation";
        $sq       = "select id,name from payment";
        $data['c']=$con->query($sql)->fetchAll();
        $data['p']=$con->query($sq)->fetchAll();
        return $data;
    }

	public static function mysql( $database ) {
	if ( self::$mysql ) {
			return self::$mysql;
		}else {
			return  self::$mysql=new DB_Mysql( Y::config()->mysql->$database->toArray());
		}
	}


	





}


?>
