<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Brithday store-@yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="{{ url('public/assets/img/faviconc.png') }}" rel="icon">
  
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

  <link href="https://fonts.googleapis.com/css2?family=Cedarville+Cursive&display=swap" rel="stylesheet">
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

 


  @yield('content')

  


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

 $(".editor-add-basket").click(function(){
    var cart_id_array = localStorage.getItem("cart_id_array");
    //console.log("cart_id_array",cart_id_array);
    if(cart_id_array){
      var cart_id = $(".cart1_id").val();
      
      if(cart_id_array.indexOf(cart_id) === -1){
        var arry_json = JSON.parse(cart_id_array);
        arry_json.push(cart_id);
        var new_local = JSON.stringify(arry_json);
        //console.log("cart_id_array",cart_id);
        localStorage.setItem("cart_id_array",new_local);
      }
      
      
    }else{
      var cart_id = $(".cart1_id").val();
    
      var cart_id_array = [];

      
      cart_id_array.push(cart_id);
      var new_array = JSON.stringify(cart_id_array);
      console.log("cart_id_array",new_array);
      localStorage.setItem("cart_id_array",new_array);
    }
    
  });

</script>
  @yield('current_page_js')
</body>

</html>