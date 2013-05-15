<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-11-12
 * Time: 下午2:25
 * To change this template use File | Settings | File Templates.
 */
class AdminController extends V_game
{

     
    function indexAction(){
        Y::disableView();
        $this->redirect("/user/list");
    }
    /**
     * 用户列表   *
     */  
    function listAction(){         
         
    }

    function addAction(){         
         
    }

    function editAction(){         
         
    }
    
     
       
}
