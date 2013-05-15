<?php
/**
 * Created by xiaomingji@candou.com .
 * User: Administrator
 * Date: 12-11-12
 * Time: 下午2:25
 * 渠道管理
 */
class ChannelModel{

    /**
     *cooperation list
     *
     * @param string $limit 
     *return array
     */
    public static function partnerList($limit){
        $con = CD::mysql('game');
        $sql = "select id,name,user_count_cur_month,user_count,order_count,order_count_cur_month,pay_amount,pay_amount_cur_month from cooperation  order by create_time desc {$limit}";
        $con->query($sql);
        $data = $con->fetchAll();
        return $data;

    }
    
    /**
     *platform list
     *
     *@param string $limit 
     *return array
     */
    public static function platformList($limit){
        $con = CD::mysql('game');
        $sql = "select id,name,default_chips,user_count_cur_month,user_count from platform {$limit}";
        $con->query($sql);
        return $data=$con->fetchAll();
    }


   

    /**
     *payment list
     *
     *@param string $limit 
     *return array
     */
    public static function payList($limit){
        $con = CD::mysql('game');
        $sql = "select id,name,order_count,order_count_cur_month,pay_amount,pay_amount_cur_month from payment {$limit}";
        $con->query($sql);
        return $data=$con->fetchAll();
    }

    /**
     *Total nameber of list ;cooperation,payment,platform
     *
     * @param string $table table's name;cooperation,payment,platform
     * return int
     */
    public static function getTotal($table){
        $con  = CD::mysql('game');
        $sql  = "select count(*) as t from {$table}";
        $count= $con->query($sql)->fetch();
        return $count['t'];

    }

    /**
     *get content
     *
     *@param $id    string
     *@param $table string 
     *return array
     */
    public static function getContent($id,$table){
        $con = CD::mysql('game');
        switch($table){
            case 'cooperation':
                $sql = "select id,name,rate,can_login,username,password,safe_email,contract,mobile,contract_id,payee_company,payee_phone,payee_licence,bank,bank_account from cooperation where id='{$id}'";
                break;
            case 'platform':
                $sql = "select id,name,default_chips,appid,appkey,config from platform where id='{$id}'";
                break;
            case 'payment':
                $sql = "select id,name,rate,appid,appkey,config from payment where id='{$id}'";
                break;
            default:
                break;
        }
        $con->query($sql);
        return $con->fetch();
    
    }

    /**
     *insert operation
     *
     *@param string $table  table's name
     *@param array  $arr post data
     *return int
     */
    public static function itemAdd($table,$arr){
        $arr = self::getPost($arr);
        $colm  = '';
        $str   = '';
        if(!empty($arr)){
            foreach($arr as $key=>$value){
                if($value!==''){
                    $colm.= $key.',';
                    $str.= "'{$value}',";
                }
            }
        }
        $colm = rtrim($colm,',');
        $str  = trim($str,',');
        $con = CD::mysql('game');
        $sql = "insert into {$table}({$colm}) values({$str}) ";
        $con->query($sql);
        if($con->affectedRows()){
            return true;
        }else{
            return false;
        }
    }

    /**
     *update operation
     *
     *@param string $table  table's name
     *@param array  $arr post data
     *return int
     */
    public static function itemedit($table,$arr){
        $arr = self::getPost($arr);
        $id  = $arr['id'];
        $str   = '';
        if(!empty($arr)){
            foreach($arr as $key=>$value){
                if($value!==''&&$key!='id'){

                   $str.="$key='{$value}',";
                }
            }
        }
        $str  = rtrim($str,',');
        $con = CD::mysql('game');
        $sql = "update {$table} set $str where id='{$id}'";
        $con->query($sql);
        if($con->affectedRows()){
            return true;
        }else{
            return false;
        }
    }

    /**
     *获取post
     *
     *@param array $arr
     *return array
     */
    public static function getPost($arr){
        foreach($arr as $key=>$val){
            if(!is_numeric($val)){
                $arr[$key] = addslashes($val);
            }
        }
        return $arr;
    } 




}

?>
