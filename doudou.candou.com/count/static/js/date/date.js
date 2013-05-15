/*
 *  Created By ZouZeHe
 *  date-setting.js
 *  2013-4-7  13:57  
 */  

    var yearTo=new Date().getYear-18+1900;
    $( ".timeInput" ).datepicker({
            dateFormat:'yy-mm-dd',
            prevText:'前一月',
            nextText:'后一月',
            dayNamesMin:['日','一','二','三','四','五','六'],
            changeYear:'true',
            monthNames:['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'],
            yearRange:'1949:'+yearTo
    });
     