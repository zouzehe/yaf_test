/*
 * MWS Admin v2.1 - Login JS
 * This file is part of MWS Admin, an Admin template build for sale at ThemeForest.
 * All copyright to this file is hold by Mairel Theafila <maimairel@yahoo.com> a.k.a nagaemas on ThemeForest.
 * Last Updated:
 * December 08, 2012
 *
 */

(function($) {
	$(document).ready(function() {
		/*
        *   按日期搜索
        */
        $("#searchByDate-btn").click(function(){
            var Info  = "startTime/"+$('#startTime').val()+
                        "/endTime/"+$('#endTime').val()+
                        "/cooperation/"+$('#cooperation').val()+
                        "/platform/"+$('#platform').val();                                                   
            $.get(
                base_url+"user/date/"+Info,
                function(data){
                 $("#mws_content").html(data);
                });
        })
        /*
        *   按渠道搜索
        */
        $("#searchByChannel-btn").click(function(){
            var Info  = "startTime/"+$('#startTime').val()+
                        "/endTime/"+$('#endTime').val();                                                   
            $.get(
                base_url+"user/qudao/"+Info,
                function(data){
                 $("#mws_content").html(data);
                });
        })
        /*
        *   按条件搜索用户
        */
        $("#searchUser-btn").click(function(){
            var Info  = "startTime/"+$('#startTime').val()+
                        "/endTime/"+$('#endTime').val()+
                        "/cooperation/"+$('#cooperation').val()+
                        "/platform/"+$('#platform').val()+
                        "/vip_type/"+$('#vip_type').val()+ 
                        "/can_speak/"+$('#can_speak').val();
                        if($('#level').val()){ 
                            Info = Info+"/level/"+$('#level').val();
                        }
                        if($('#client').val()){
                            Info = Info+"/client/"+$('#client').val();
                        }
            $.get(
                base_url+"user/search/"+Info,
                function(data){
                 $("#mws_content").html(data);
                });
        })  

        $("#sort").change(function(){
            var Info  = "startTime/"+$('#startTime').val()+
                        "/endTime/"+$('#endTime').val()+
                        "/cooperation/"+$('#cooperation').val()+
                        "/platform/"+$('#platform').val()+
                        "/vip_type/"+$('#vip_type').val()+ 
                        "/can_speak/"+$('#can_speak').val()+
                        "/sort/"+$('#sort').val(); 
                        if($('#level').val()){ 
                            Info = Info+"/level/"+$('#level').val();
                        }
                        if($('#client').val()){
                            Info = Info+"/client/"+$('#client').val();
                        }
            $.get(
                base_url+"user/search/"+Info,
                function(data){
                 $("#mws_content").html(data);
            });
             
         
        })          

	});
}) (jQuery);

function onlyInt(event){
    event.value=event.value.replace(/\D/g,'');
     
}
