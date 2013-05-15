function getObj(id){
        var obj = document.getElementsByName(id);
        return obj[0].value;
    }

     function check(){
        var nameVal  = getObj('name');
        var idVal  = getObj('id');
        if(nameVal&&idVal){
            return true;
       }else{
            if(nameVal==''){
           }

           return false;
       }
     } 
