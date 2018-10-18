<section class="page-title bg-overlay-black-60 parallax" data-jarallax='{"speed": 0.6}' style="background-image: url(<?php echo Smart::loadAsset('images/bg/05.jpg')?>);">
  <div class="container">
    <div class="row"> 
      <div class="col-lg-12"> 
       <div class="page-title-name">
           <h1>Contact Us</h1>
          <p>Get In Touch with Us</p>
        </div>
          <ul class="page-breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-double-right"></i></li>
            <li><span>Contact Us</span> </li>
       </ul>
      </div>
     </div>
  </div>
</section>
<section class="theme-bg contact-2 clearfix o-hidden">
   <div class="container-fluid pos-r">
    <div class="row">
    <div class="col-lg-6 col-md-6 map-side g-map map-right" id="map" data-type='black'>
    </div>
   </div>
  </div>
  <div class="container">
  <div class="row">
      <div class="col-lg-5 col-md-5"> 
      
      <div class="contact-3-info page-section-ptb text-white">
       <div class="clearfix">
       <h6 class="text-white">Our Offices</h6>
           <h2 class="text-white">Contact Info</h2>
           <p class="mb-50 text-white">It would be great to hear from you! If you got any questions, please do not hesitate to send us a message. We are looking forward to hearing from you! We reply within <span class="tooltip-content-2" data-original-title="Mon-Fri 10am–7pm (GMT +1)" data-toggle="tooltip" data-placement="top"> 24 hours!</span></p>

           <ul class="addresss-info list-unstyled"> 
            <li><i class="ti-map-alt"></i> <p>Address: 2896 Westbury Court, Mississauga, ON, Canada <br>L5M 6B2</p> </li>
            <li><i class="ti-mobile"></i>Phone: +1 (416) 550-0717</li>
            <li><i class="ti-email"></i>Email: info@whistlertech.ca</li>
          </ul>
          <div class="social-icons border rounded color-hover mt-50">
                <ul>
                  <li class="social-facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                  <li class="social-twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                  <li class="social-dribbble"><a href="#"><i class="fa fa-dribbble"></i> </a></li>
                  <li class="social-vimeo"><a href="#"><i class="fa fa-vimeo"></i> </a></li>
                  <li class="social-pinterest"><a href="#"><i class="fa fa-pinterest-p"></i> </a></li>
                  <li class="social-behance"><a href="#"><i class="fa fa-behance"></i> </a></li>
                  <li class="social-linkedin"><a href="#"><i class="fa fa-linkedin"></i> </a></li>
                </ul>
             </div>
            </div>          
         </div>
      </div>
     </div>
    </div>
</section>
 
<section class="page-section-ptb contact-2">
  <div class="container">
  <div class="row text-center mb-50">
  <div class="col-md-offset-2 col-md-8">
      <div class="section-title">  
      <h6>let's work together</h6>
       <h2 class="title-effect">Contact Us</h2>
       <p>It would be great to hear from you! If you got any questions.</p>
       </div>
   </div>
   </div>
  <div class="row">
  <div class="col-sm-12">
    <div id="formmessage">Success/Error Message Goes Here</div>
     <form class="form-horizontal" id="contactform" role="form" method="post" action="php/contact-form.php">
      <div class="contact-form clearfix">
        <div class="section-field">
          <input id="name" type="text" placeholder="Name*" class="form-control"  name="name">
         </div> 
         <div class="section-field">
            <input type="email" placeholder="Email*" class="form-control" name="email">
          </div>
         <div class="section-field">
            <input type="text" placeholder="Phone*" class="form-control" name="phone">
          </div>
         <div class="section-field textarea">
           <textarea class="input-message form-control" placeholder="Comment*"  rows="7" name="message"></textarea>
          </div>
		    <!-- Google reCaptch-->
			<div class="g-recaptcha section-field clearfix" data-sitekey="[Add your site key]"></div>
			<div class="section-field submit-button">
				<input type="hidden" name="action" value="sendEmail"/>
			   <button id="submit" name="submit" type="submit" value="Send" class="button"><span> Send message </span> <i class="fa fa-paper-plane"></i></button>
		   </div>
          </div> 
        </form>
       <div id="ajaxloader" style="display:none"><img class="center-block mt-30 mb-30" src="images/pre-loader/loader-02.svg" alt=""></div>
      </div>
     </div>
    </div>
</section>