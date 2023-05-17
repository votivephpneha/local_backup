 <footer id="footer">
   <div class="footer-top">
     <div class="container">
       <div class="row">

         <div class="col-lg-3 col-md-6 ">
           <a href="#" class="logo-foter"><img src="{{ url('public/assets/img/logo.png') }}" class="mb-2"> </a>

           <div class="footer-newsletter">
             <h5 class="fowl">Follow Us</h5>
             <a href="#"><img src="{{ url('public/assets/img/ph_instagram-logo.svg') }}" class="mb-2"> </a>
             <a href="#"><img src="{{ url('public/assets/img/ic_sharp-facebook.svg') }}" class="mb-2"> </a>
             <a href="#"><img src="{{ url('public/assets/img/carbon_logo-youtube.svg') }}" class="mb-2"> </a>
             <a href="#"><img src="{{ url('public/assets/img/logos_tiktok.svg') }}" class="mb-2 tikto-sic"> </a>
           </div>
           <div class="mt-3 payment-icon">
             <h5 class="fowl mb-1">We Accept </h5>
             <a href="#"><img src="{{ url('public/assets/img/logos_visa.svg') }}"></a>
             <a href="#"><img src="{{ url('public/assets/img/logos_mastercard.svg') }}"></a>
             <a href="#"><img src="{{ url('public/assets/img/logos_maestro.svg') }}"></a>
             <a href="#"><img src="{{ url('public/assets/img/Vector.svg') }}"></a>
             <a href="#"><img src="{{ url('public/assets/img/fa_cc-paypal.svg') }}"></a>
             <a href="#"><img src="{{ url('public/assets/img/la_cc-apple-pay.svg') }}"></a>
             <a href="#"> <img src="{{ url('public/assets/img/fa_cc-discover.svg') }}" class=""></a>
             <a href="#"> <img src="{{ url('public/assets/img/logos_google-pay.svg') }}" class=""></a>

           </div>
         </div>

         <div class="col-lg-3 col-md-6 footer-links-addres">
           <h4>Contact Us</h4>

           <ul>
             <li> <a href="#"><img src="{{ url('public/assets/img/Vector.png') }}"> Address 5171 Will Goes
                 Here</a></li>
             <li> <a href="#"><img src="{{ url('public/assets/img/Vector-1.png') }}"> Call Us 0123456789</a></li>
             <li> <a href="#"> <img src="{{ url('public/assets/img/ic_outline-email.png') }}"> Email <label style="
    text-decoration: underline;">info@gmail.com</label></a></li>

           </ul>
         </div>


         <div class="col-lg-3 col-md-6 footer-links">
           <h4>Quick Links</h4>

           <ul>
             <li> <a href="#"> Home</a></li>
             <li> <a href="#">About</a></li>
             <li> <a href="#">Birthday Cards</a></li>
             <li> <a href="#">Video Message Cards</a></li>
             <li> <a href="#">Personalised Gifts</a></li>
             <li> <a href="#">Create Your Card</a></li>

           </ul>
         </div>

         <div class="col-lg-3 col-md-6 footer-links">
           <h4>Account</h4>
           <ul>
             <li>
                @if(!Auth::check())
                <a href="{{ url('/loginUser') }}"> Sign In</a>
                @else
                <a href="{{ url('user/userProfile') }}"> Profile</a>
                @endif
             </li>
             <li> <a href="#">View Cart</a></li>
             <li> <a href="#">My Wishlist</a></li>
             <li> <a href="#">Track My Order</a></li>
             <li> <a href="#">Shipping Details</a></li>
             <li> <a href="#">Help Ticket</a></li>

           </ul>
         </div>



       </div>
     </div>
   </div>

   <div class="brith-foter">
     <div class="copyright" style="font-size: 12px;">
       © 2023<strong> <span>Brithday store.</span></strong>
     </div>

   </div>
 </footer> <!-- End Footer