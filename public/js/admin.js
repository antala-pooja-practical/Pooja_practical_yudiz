$(document).ready(function () {
  
  //Product add form validation
  $('#productAdd').validate({
     rules:{
         product_name:{required: true},
         product_qut:{required: true,number: true},
         product_status:{required: true},
         price:{required: true,number: true},
     },
     submitHandler: function(form) {
     form.submit();
   }
 });
 
});