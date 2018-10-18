<footer class="footer footer-maroon">
    <div class="container">
        
    </div>
    <div class="copyright footer-gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <ul class="list-inline text-left">
                        <li><a href="<?php echo Smart::loadAsset('docs/famiquity-terms-of-use .pdf')?>" target="_blank">Terms &amp; Conditions </a> &nbsp;&nbsp;&nbsp;|</li>
                        <li><a href="<?php echo Smart::loadAsset('docs/famiquity-privacy-policy.pdf')?>" target="_blank">Privacy Policy </a> &nbsp;&nbsp;&nbsp;|</li>
                        <li><a href="#">Cookies </a></li>
                    </ul>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="social text-right hidden">
                        <ul>
                            <li>
                                <a href="#"> <i class="fa fa-facebook"></i> </a>
                            </li>
                            <li>
                                <a href="#"> <i class="fa fa-twitter"></i> </a>
                            </li>

                            <li>
                                <a href="#"> <i class="fa fa-dribbble"></i> </a>
                            </li>

                            <li>
                                <a href="#"> <i class="fa fa-linkedin"></i> </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p> &copy; Copyright <span id="copyright"> <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script></span> <a href="#">. </a> All Rights Reserved </p>
                </div>
            </div>
        </div>
    </div>
</footer>

<div id="back-to-top" class="hidden"><a class="top arrow" href="#top"><i class="fa fa-angle-up"></i> <span>TOP</span></a></div>

<script type="text/javascript" src="<?php echo Smart::loadJs('plugins-jquery.js'); ?>"></script>
<script type="text/javascript" src="<?php echo Smart::loadJs('select2.min.js'); ?>"></script>

<script type="text/javascript">var plugin_path = folder+'/assets/js/';</script>
<script type="text/javascript" src="<?php echo Smart::loadAsset('revolution/js/jquery.themepunch.tools.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo Smart::loadAsset('revolution/js/jquery.themepunch.revolution.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo Smart::loadAsset('revolution/js/extensions/revolution.extension.actions.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo Smart::loadAsset('revolution/js/extensions/revolution.extension.carousel.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo Smart::loadAsset('revolution/js/extensions/revolution.extension.kenburn.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo Smart::loadAsset('revolution/js/extensions/revolution.extension.layeranimation.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo Smart::loadAsset('revolution/js/extensions/revolution.extension.migration.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo Smart::loadAsset('revolution/js/extensions/revolution.extension.navigation.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo Smart::loadAsset('revolution/js/extensions/revolution.extension.parallax.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo Smart::loadAsset('revolution/js/extensions/revolution.extension.slideanims.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo Smart::loadAsset('revolution/js/extensions/revolution.extension.video.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo Smart::loadAsset('revolution/js/revolution-custom.js'); ?>"></script> 

<script type="text/javascript" src="<?php echo Smart::loadJs('custom.js'); ?>"></script>
<script src="<?php echo base_url("assets/js/app/app.class.js")?>"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>



<script type="text/javascript">
    $(document).ready(function(){

       $('input[type="number"]').spinner();
       
       $('input[type="number"]').parent().parent('.field-widget').css('display','table');

   })
</script>


<style type="text/css">
.ui-spinner{
    width: 100%;
    padding-right: 2px;
}
.ui-spinner-up ,.ui-spinner-down{
    margin-right: 28px;
    border: none !important;
}

.ui-spinner-input{
    margin: 0 !important;
}
input[type=number]
{
  -moz-appearance: textfield;
}
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
</style>

<?php
if(!empty($footerJs)):
    foreach ($footerJs as $js):
      ?>
      <script src="<?php echo $js;?>"></script>
      <?php
  endforeach;
endif;
?>
</body>
</html>