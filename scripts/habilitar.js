$(function(){
   $("#idimportado").change(function(){
       var st = this.checked;
          if(st){
              $("#nomeportugues").pro("disabled",false);
          }else{
              $("#nomeportugues").pro("disabled",true);
          }
       
       
   });        
});