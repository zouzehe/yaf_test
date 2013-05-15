/*
 * MWS Admin v2.1 - Login JS
 * This file is part of MWS Admin, an Admin template build for sale at ThemeForest.
 * All copyright to this file is hold by Mairel Theafila <maimairel@yahoo.com> a.k.a nagaemas on ThemeForest.
 * Last Updated:
 * December 08, 2012
 *
 */

    function speakReason(){
        var expire=$("#expire").find('option:selected').text();
        var reason = "由于您在游戏中有不文明用语，你已被GM禁言"+expire;
        var flag = $("#expire option:last").attr("selected"); 
        if(flag == "selected"){
            var reason = "由于您在游戏中有不文明用语，你已被GM永久禁言";
        } 
        $("#reason").val(reason);
    }

    function kickReason(){
        var type=$("#type").find('option:selected').text();
        var expire=$("#expire").find('option:selected').text();
        var reason = "由于您违法游戏规则，你已被GM踢出"+type+"，请于"+expire+"后再进行游戏";
        var flag = $("#expire option:last").attr("selected"); 
        if(flag == "selected"){
            var reason = "由于您违法游戏规则，你已被永久封号！";
        } 
        $("#reason").val(reason);
    }
    

 
                                         

                                       
 