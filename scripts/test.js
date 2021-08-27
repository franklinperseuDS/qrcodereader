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
$(document).ready(function () {
  $("#anythingSearch").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    $("#myDIV *").filter(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
$('.mdb-select').materialSelect({
});