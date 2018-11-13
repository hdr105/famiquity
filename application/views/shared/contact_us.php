<!DOCTYPE html>
<html lang="en">
<head>
  <base href="<?php echo base_url(); ?>">
  <script>
    var base_url =  '<?php echo base_url(); ?>';
</script>
<title>Contact Us</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
<link rel="icon" type="image/png" href="assets/contact-us/images/icons/favicon.ico"/>
<!--===============================================================================================-->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
   <link href="<?php echo base_url(); ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
   <link href="<?php echo base_url(); ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
   <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
   <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
   <!-- END GLOBAL MANDATORY STYLES -->
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="assets/contact-us/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="assets/contact-us/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="assets/contact-us/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="assets/contact-us/vendor/animate/animate.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="assets/contact-us/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="assets/contact-us/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="assets/contact-us/vendor/select2/select2.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="assets/contact-us/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="assets/contact-us/css/util.css">
<link href="<?php echo base_url(); ?>assets/layouts/layout5/css/custom.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="assets/contact-us/css/main.css">
<script src="assets/contact-us/vendor/jquery/jquery-3.2.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/contact-us/vendor/confirm/jquery-confirm.min.css">
<script src="assets/contact-us/vendor/confirm/jquery-confirm.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!--===============================================================================================-->

</head>


<body>


    <div class="container-contact100">

    <div class="row locsearchbar">
        <div class="col-md-6 margin-bottom-10">
            <input type="text" placeholder="Search Location" class="form-control" id="search_autocomplete">
        </div>
        <div class="col-md-2"><button class="btn btn-success filter_btn">Add Filter</button></div>
    </div>

    <div class="row filter_div">
        <div class="col-md-6 margin-bottom-10">
            <select class="form-control filter_select" multiple="">
                <?php
                foreach ($filters as $key => $value) {
                    echo "<option value='".$value."'>".$value."</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-2"><button class="btn btn-success search_filter">Search</button></div>
    </div>

    <div class="contact100-map" id="map" style="width: 100%"></div>


</div>





<div id="dropDownSelect1"></div>

<!--===============================================================================================-->

<!--===============================================================================================-->
<script src="assets/contact-us/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="assets/contact-us/vendor/bootstrap/js/popper.js"></script>
<script src="assets/contact-us/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="assets/contact-us/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="assets/contact-us/vendor/daterangepicker/moment.min.js"></script>
<script src="assets/contact-us/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="assets/contact-us/vendor/countdowntime/countdowntime.js"></script>
  <script src="<?php echo base_url(); ?>assets/html5lightbox/html5lightbox.js"></script>
<!--===============================================================================================-->
   <script src="https://maps.googleapis.com/maps/api/js?key=
AIzaSyCLZzq31lWF8Oo31xbFTqHchlmXIfzqeAI&libraries=places&callback=initialize" async defer></script>
<script src="assets/contact-us/js/map-custom.js"></script>
<!--===============================================================================================-->
<script src="assets/contact-us/js/main.js"></script>


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');

  $(".filter_select").select2();
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".filter_div").hide();

        $(".filter_btn").click(function(){
            $(".filter_div").slideToggle();
        })

        $(".search_filter").click(function(){
            add_markers();
        })


      
    })
</script>

<script type="text/javascript">
  function advertiseaa(id) {
         //var id = $(this).attr('data-id');
            //alert("admin"+id);
  $.confirm({
    title: 'Contact Us',
    content: 'url:'+base_url+'contact/form_load',
    buttons: {
      Advertise: {
        text: 'Advertise',
        btnClass: 'btn-orange',
        action: function () {


          $("#sendmail").submit(function(e) {
             e.preventDefault();

          });

          $.ajax({
            url: base_url+"contact/send_mail",
            type: 'POST',
            dataType: 'json',
            data: $("#sendmail").serialize(),
            success: function(data) {
              if(data.status)
            {
                toastr.success(data.message,'Email Send');

            }
            else
            {
                toastr.error(data.message);
            }

            $("#sendmail").trigger("reset");
              
            }
          });


             
        }
      },
      later: function () {
            // do nothing.
         }
    }
});
        }
    </script>

</body>
</html>
