<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Brithday store-@yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="icon" href="{{asset('public/images/newicon.ico')}}" type="image/ico" />
  
  <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&family=Source+Sans+Pro:wght@200;300;400;600;700&display=swap" rel="stylesheet">

  <link href="{{ url('public/assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
  <link href="{{ url('public/assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ url('public/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ url('public/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ url('public/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ url('public/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ url('public/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ url('public/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <link href="{{ url('public/assets/css/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
  <style>
    .error{
      color:red;
    }
  /*  .user_registration{
      width:500px;
      margin: auto;
      margin-top: 120px;
    }*/
    .user_profile_div{
      margin-top: 200px;
    }
    .card_page{
      margin-top: 160px;
	  margin-bottom: 50px;
    }
    .card_image img{
      width:100%;
    }
  </style>
  @yield('current_page_css')
  
</head>

<body>

  <!-- Navbar Header -->
  @include('Front.layout.header')


  @yield('content')

  <!-- /.Footer -->
  @include('Front.layout.footer')


  <!-- Vendor JS Files -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="{{ url('public/assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ url('public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ url('public/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ url('public/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ url('public/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ url('public/assets/js/main.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script>
  $(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='registration']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      fname: "required",
      lname: "required",
      email: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        email: true
      },
      password: {
        required: true,
        minlength: 5
      }
    },
    // Specify validation error messages
    messages: {
      fname: "Please enter your firstname",
      lname: "Please enter your lastname",
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      email: {
        required: "Please enter the email address",
        email: "Please enter a valid email address"
      }
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='loginUser']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      fname: "required",
      lname: "required",
      email: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        email: true
      },
      password: {
        required: true,
        minlength: 5
      }
    },
    // Specify validation error messages
    messages: {
      fname: "Please enter your firstname",
      lname: "Please enter your lastname",
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      email: "Please enter a valid email address"
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
 }); 
  $(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='change_password']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      old_password: "required",
      new_password: {
        required: true,
        minlength: 5
      },
      confirm_password:{
        required:true,
        equalTo:'#new_password'
      },
    },
    // Specify validation error messages
    messages: {
      old_password: "Please provide a old password",
      
      new_password: {
        required: "Please provide a new password",
        minlength: "Your password must be at least 5 characters long"
      },
      confirm_password: {
        required: "Please provide a Confirm Password",
        equalTo: "The new password and confirm password does not match"
      }
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});
 $(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='resetPassword']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      new_password: {
        required: true,
        minlength: 5
      },
      confirm_password:{
        required:true,
        equalTo:'#new_password'
      },
    },
    // Specify validation error messages
    messages: {
      new_password: {
        required: "Please provide a new password",
        minlength: "Your password must be at least 5 characters long"
      },
      confirm_password: {
        required: "Please provide a Confirm Password",
        equalTo: "The new password and confirm password does not match"
      }
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});  
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='contact_form']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      fname: "required",
      email: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        email: true
      },
      phone_no: "required",
      subject: "required",
      message: "required",
      
    },
    // Specify validation error messages
    messages: {
      fname: "Please enter your name",
      phone_no: "Please enter your phone number",
      subject: "Please enter the subject",
      email: {
        required: "Please enter the email address",
        email: "Please enter a valid email address"
      },
      message: "Please enter the message",
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});
  $(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='checkout_form']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      fname: "required",
      lname: "required",
      address: "required",
      city: "required",
      country: "required",
      post_code: "required",
      phone_no: "required",
      email_address: "required"
      
    },
    // Specify validation error messages
    messages: {
      fname: "Please provide a first name",
      lname: "Please provide a last name",
      address: "Please provide address",
      city: "Please provide city",
      country: "Please provide country",
      post_code: "Please provide a postal code",
      phone_no: "Please provide a phone no",
      email_address: "Please provide a email address"
      
      
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
      localStorage.removeItem("cart_id_array");
    }
  });
});
  $(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='trackorder_form']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      order_no: "required",
      email_phone: "required"
      
    },
    // Specify validation error messages
    messages: {
      order_no: "Please provide the order number",
      email_phone: "Please provide the email or phone number"
      
      
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      console.log("form",form);
      var order_no = $("#order_no").val();
      var email_phone = $("#email_phone").val();

      $.ajax({
        type: "POST",
        url: "{{ url('trackorder_submit') }}",
        data: {order_no:order_no,email_phone:email_phone,_token:"{{ csrf_token() }}"},
        cache: false,
        success: function(data){
          console.log("data",data);
          $(".order_track_data").html(data);
        }
      });
    }
  });
});
//  $(function() {
//   // Initialize form validation on the registration form.
//   // It has the name attribute "registration"
//   $("form[name='post_sizes_form']").validate();
// });
$(".close").click(function(){
  $(".alert-success").hide();
  $(".alert-danger").hide();
});

</script>
<script type="text/javascript">
 function addFav(user_id,card_id){
  //alert(user_id);
  
  if($(".card_image .fav-"+card_id+" i").hasClass("fa-heart-o")){
    $(".card_image .fav-"+card_id).html("<i class='fa fa-heart'></i>");
  }else{
    if($(".card_image .fav-"+card_id+" i").hasClass("fa-heart")){
      $(".card_image .fav-"+card_id).html("<i class='fa fa-heart-o'></i>");
    }
  }
  //$(".card_image .fav-"+card_id).html("<i class='fa fa-heart'></i>");
 }
 $(document).ready(function(){
  $(".card_carousel").owlCarousel({
    items:1,
    
    nav:true,
    dots:true
  });

});
var sum = 0;
 $(".cart_price").each(function(i,val){
    var card_price = $.trim($(this).html()).replace("$","");
    sum = parseInt(sum) + parseInt(card_price);
    console.log("cart_price",$.trim($(this).html()).replace("$",""));

 });
 console.log("cart_price",sum.toFixed(2));
 $(".total_price").html("$"+sum.toFixed(2));

function qtyInc(event,cart_id,cart_price,size_qty){
  //alert(cart_id);
  

  if(event == 'plus'){

    
    $(".min-"+cart_id).removeAttr("disabled");
    var qty_value = $("#qty-"+cart_id).val();
    qty_value++;
    $("#qty-"+cart_id).val(qty_value);
    var price = qty_value * cart_price;
    $("#qty-"+cart_id).val();
    $(".cart_price-"+cart_id).text("$"+price.toFixed(2));
    var remaining_qty = size_qty - qty_value;
    //alert(remaining_qty);
    if(remaining_qty<1){
      $(".qty_td-"+cart_id+" .qty_not_available").show();
      $(".plus-"+cart_id).attr("disabled","disabled");
    }

    $.ajax({
      type: "post",
      url: "{{ url('/post_cart') }}",
      data: {cart_id:cart_id,price:price,qty:qty_value,_token:"{{ csrf_token() }}"},
      cache: false,
      success: function(data){
         //$("#resultarea").text(data);
      }
    });

    var price_sum = 0;
    
    $(".cart_price").each(function(i,val){
      var price = $.trim($(this).html().replace("$",""));
      
      price_sum = parseInt(price_sum) + parseInt(price);
    });
    console.log("price",price_sum);
    $(".total_price").html("$"+price_sum.toFixed(2));
  }

  if(event == 'minus'){
    var qty_value = $("#qty-"+cart_id).val();
    qty_value--;
    if(qty_value < 2){
      $(".min-"+cart_id).attr("disabled","disabled");
    }
    $("#qty-"+cart_id).val(qty_value);
    var price = qty_value * cart_price;

    $("#qty-"+cart_id).val();
    $(".cart_price-"+cart_id).text("$"+price.toFixed(2));

    var remaining_qty = size_qty - qty_value;
    //alert(remaining_qty);
    if(remaining_qty > 0){
      $(".qty_td-"+cart_id+" .qty_not_available").hide();
      $(".plus-"+cart_id).removeAttr("disabled");
    }

    $.ajax({
      type: "post",
      url: "{{ url('/post_cart') }}",
      data: {cart_id:cart_id,price:price,qty:qty_value,_token:"{{ csrf_token() }}"},
      cache: false,
      success: function(data){
         //$("#resultarea").text(data);
      }
    });

    

    var price_sum = 0;
    
    $(".cart_price").each(function(i,val){
      var price = $.trim($(this).html().replace("$",""));
      
      price_sum = parseInt(price_sum) + parseInt(price);
    });
    console.log("price",price_sum);
    $(".total_price").html("$"+price_sum.toFixed(2));
  }
}

var cart_id_array = localStorage.getItem("cart_id_array");
  var arry_json = JSON.parse(cart_id_array);

  
  $.each(arry_json,function(i,val){
      console.log("val",val);

    $.ajax({
      type: "GET",
      url: "{{ url('cart_table') }}",
      data: {cart_id:val},
      cache: false,
      success: function(data){
        
        
      }
    });
    
  });

  // $(".user_logout").click(function(){
  //   localStorage.removeItem("cart_id_array");
  // });

  function clickSize(size_value,card_size_price){
    //alert(size_value);
    $(".card_size_price").val(card_size_price);
  }

  function remove_fav(favourite_card_id){
    $.ajax({
      type: "GET",
      url: "{{ url('user/favourites_delete') }}",
      data: {favourite_card_id:favourite_card_id},
      cache: false,
      success: function(data){
        window.location.href = "{{ url('user/user_favourites') }}";
        
      }
    });
  }

  var cart_id_array = localStorage.getItem("cart_id_array");
  $(".cart_id_array").val(cart_id_array);
  var arry_json = JSON.parse(cart_id_array);

  var sum = 0;
  $.each(arry_json,function(i,val){
      

    $.ajax({
      type: "GET",
      url: "{{ url('checkout_data') }}",
      data: {cart_id:val},
      cache: false,
      success: function(data){
        
        $(".checkout_table_data").prepend(data);
        var card_price = $.trim($(".total_card_price-"+val).html()).replace("$","");
        
        sum = parseInt(sum) + parseInt(card_price);

        console.log("cart_price2",sum);

        $(".pay_now_price").html("$"+sum.toFixed(2));
        $(".order_total_price").val(sum.toFixed(2));
      }
    });
    
  });

  function changeCountry(){
    var country_id = $("#country").val();
    //alert(country_id);
    $.ajax({
      type: "GET",
      url: "{{ url('get_state') }}",
      data: {country_id:country_id},
      cache: false,
      success: function(data){
        //console.log("data",data);
        
          $("#state").html(data);
        
        
      }
    });
  }

  function changeState(){
    var state_id = $("#state").val();
    //alert(country_id);
    $.ajax({
      type: "GET",
      url: "{{ url('get_city') }}",
      data: {state_id:state_id},
      cache: false,
      success: function(data){
        //console.log("data",data);
        
          $("#city").html(data);
        
        
      }
    });
  }


   function searchProduct(){

    $(".search-drpdwn").show();
    var search = $(".search").val();
    
    $.ajax({
      type: "GET",
      url: "{{ url('get_cards') }}",
      data: {search_words:search},
      cache: false,
      success: function(data){
        //console.log("data",data);
        
        $(".search-drpdwn-products").html(data);
        
        
      }
    });
  }

  $(document).mouseup(function(e){
    var search_box = $(".search-drpdwn");

    // If the target of the click isn't the container
    if(!search_box.is(e.target) && search_box.has(e.target).length === 0){
        search_box.hide();
    }
  });
 

 function searchModel(card_id){
   
   $.ajax({
    type: "GET",
    url: "{{ url('searchModel') }}",
    data: {card_id:card_id},
    cache: false,
    success: function(data){
      //console.log("data",data);
      
      $(".searchModal").html(data);
      $(".close").click(function(){
        $(".modal").hide();
      });
      $(".card_carousel").owlCarousel({
    items:1,
    
    nav:true,
    dots:true
  });

      
    }
  });
 }


 

</script>
<script type="text/javascript">
  
</script>

  @yield('current_page_js')
</body>

</html>