   $(function(){
        $('.recommend a').live('click',function(event){ 
            event.preventDefault();
            var appid = $(this).parents('tr').attr('id');
            var act   = $(this).attr('class');
            var _this = $(this);
            $.post('/android/index/recommend', {appid: appid, act: act}, function(d){
                if (d.stat = 1) {
                    $(_this).parent().html(d.msg);
                }
            }, 'json');
        });
        $('.hotapps a').live('click',function(event){ 
            event.preventDefault();
            var appid = $(this).parents('tr').attr('id');
            var act   = $(this).attr('class');
            var _this = $(this);
            $.post('/android/index/hotapps', {appid: appid, act: act}, function(d){
                if (d.stat = 1) {
                    $(_this).parent().html(d.msg);
                }
            }, 'json');
        });
        $('.clear a').live('click',function(event){ 
            event.preventDefault();
            var type = $(this).attr('id');
            var act   = $(this).attr('class');
            var _this = $(this);
            $.post('/android/clear/index', {type:type,category:act}, function(d){
                if (d.stat = 1) {
                    alert("清除完成");
                }
            }, 'json');
        });
    });
   function edit_display_order(id){
        var order = $("#display"+id).val();
        $.post(
            "/android/index/editorder", {appid:id, order:order},
            function (data) {
                switch (data.stat) {
                    case 1:
                        $().toastmessage('showToast', {
                            text     : '修改成功',
                            position : 'middle-right',
                            type     : 'success',
                            stayTime: 1000
                        });
                        break;
                    default:
                        $().toastmessage('showToast', {
                            text     : '修改失败',
                            position : 'middle-right',
                            type     : 'error',
                            stayTime: 1000
                        });
                        break;
                }
            });
    }
    function delroll(id){
        $.post("/android/roll/del", {rollid:id},
            function (data) {
                switch (data.stat) {
                    case 1:
                        $().toastmessage('showToast', {
                            text     : '删除成功',
                            position : 'middle-right',
                            type     : 'success',
                            stayTime: 1000,
                            close    : function () {window.location.href="/android/roll/show";}
                        });
                        break;
                    default:
                        $().toastmessage('showToast', {
                            text     : '删除失败',
                            position : 'middle-right',
                            type     : 'error',
                            stayTime: 1000
                        });
                        break;
                }
            });
    }
    function editrollweight(id){
        var weight = $("#weight"+id).val();
        $.post(
            "/android/roll/editweight", {rollid:id, weight:weight},
            function (data) {
                switch (data.stat) {
                    case 1:
                        $().toastmessage('showToast', {
                            text     : '修改成功',
                            position : 'middle-right',
                            type     : 'success',
                            stayTime: 1000,
                            close    : function () {window.location.href="/android/roll/show";}
                        });
                        break;
                    default:
                        $().toastmessage('showToast', {
                            text     : '修改失败',
                            position : 'middle-right',
                            type     : 'error',
                            stayTime: 1000
                        });
                        break;
                }
            });
    }
    function delkeyword(id){
        $.post("/android/keyword/del", {id:id},
            function (data) {
                switch (data.stat) {
                    case 1:
                        $().toastmessage('showToast', {
                            text     : '删除成功',
                            position : 'middle-right',
                            type     : 'success',
                            stayTime: 1000,
                            close    : function () {window.location.href="/android/keyword/index";}
                        });
                        
                        break;
                    default:
                        $().toastmessage('showToast', {
                            text     : '删除失败',
                            position : 'middle-right',
                            type     : 'error',
                            stayTime: 1000
                        });
                        break;
                }
            });
    }
    function editweight(id){
        var weight = $("#weight"+id).val();
        $.post(
            "/android/keyword/editweight", {id:id, weight:weight},
            function (data) {
                switch (data.stat) {
                    case 1:
                         $().toastmessage('showToast', {
                            text     : '修改成功',
                            position : 'middle-right',
                            type     : 'success',
                            stayTime: 1000
                        });
                        break;
                    default:
                        $().toastmessage('showToast', {
                            text     : '删除失败',
                            position : 'middle-right',
                            type     : 'error',
                            stayTime: 1000
                        });
                        break;
                }
            });
    }