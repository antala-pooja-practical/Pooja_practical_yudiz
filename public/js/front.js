$(document).ready(function () {
  
  $(".update-cart").change(function (e) {
    e.preventDefault();
    var ele = $(this);
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
     $.ajax({
        url: getsiteurl() + '/update/cart',
        method: "patch",
        data: {_token: CSRF_TOKEN, id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
        success: function (response) {
            window.location.reload();
        }
     });
 });
 
});