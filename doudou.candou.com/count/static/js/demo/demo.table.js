/*
 * MWS Admin v2.1 - Table Demo JS
 * This file is part of MWS Admin, an Admin template build for sale at ThemeForest.
 * All copyright to this file is hold by Mairel Theafila <maimairel@yahoo.com> a.k.a nagaemas on ThemeForest.
 * Last Updated:
 * December 08, 2012
 *
 */

;(function( $, window, document, undefined ) {

    $(document).ready(function() {


        // Data Tables
        if( $.fn.dataTable ) {
            $(".mws-datatable").dataTable();
            $(".mws-datatable-fn").dataTable({
                sPaginationType: "full_numbers",
                bPaginate : false,
                bInfo : false,
                bStateSave: true,
                bSort: true, //是否支持排序功能
                bFilter: false, //搜索栏
                bJQueryUI : false, 
                oLanguage: {
                    "sLengthMenu": "每页显示 _MENU_ 条记录",
                    "sZeroRecords": "对不起，查询不到任何相关数据",
                    //"sInfo": "当前显示 _START_ 到 _END_ 条，共 _TOTAL_ 条记录",
                    "sInfoEmtpy": "找不到相关数据",
                    "sInfoFiltered": "数据表中共为 _MAX_ 条记录",
                    "sProcessing": "正在加载中...",
                    //"sSearch": "搜索",                    
                }, //多语言配置
            });

            $(".dataTables_length").css('color','white'); //修改css样式
        }

    });

}) (jQuery, window, document);