

<?php $this->load->view('shared/_page_banner_empty');  ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "People you Confide with", "txt3" => "")); ?>
    <div class="container form-margin">
        <?php
        echo form_open(base_url('save-confide'), array("METHOD"=>"POST"));
        ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php
                $this->load->view('shared/_bar', array('percentage'=>$percentage, 'level'=>1));
                echo Smart::softErrors();
                echo Smart::formErrors();
                ?>
                <div id="register-form" class="register-form">
                  <div>
                    <h5>Life Decision : <?php echo $this->session->userdata('life_decision'); ?></h5>
                    <hr>
                  </div>
                    <div class="section-field">
                        <label><?php echo $this->labelArray['confide'];?></label>
                        <div class="field-widget remember-checkbox">
                            <!-- <?php echo Smart::checkListSmart('confide[]', $list, 'id', 'name', explode(",", $app->confide))?>  -->
                            <!-- junaid -->
                             <div class="input-group">
                             <div class="multi" id="multi" style="height: 50px;"></div>

                            <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content="After making selections, move the cursor off the box, and click on the screen to reduce the box"><i class="fa fa-2x fa-question-circle"></i></button>
                            </div>
                          </div>


                             <input type="hidden" name="confide" class="confide">

                       <!--    <select class="js-example-basic-multiple" name="confide[]" multiple="multiple" value='<?php Smart::setValue("confide",explode(",", $app->confide)); ?>'> 
                               <?php
                               foreach ($list as $value) {
                                $value = (array) $value;
                                $name =  $value['name'];
                                $id = $value['id'];
                                ?>

                                <option value="<?php echo $id; ?>"><?php echo $name; ?></option>

                                <?php
                            }
                            ?>
                        </select>   -->
                        <!-- end --> 
                   

                    </div>
                </div> 
            </div>
            <!-- <?php echo "<pre>";print_r($list); ?> -->

            <?php $this->load->view('shared/_buttons', array("prev_page"=>$prev_page,"next_page"=>$next_page, "show_assessment"=>$show_assessment));?>
        </div>
    </div>
    <?php
    echo form_close();
    ?>

</div>

</section>
<script>

  $(document).ready(function() {

      
      $(".control").css("display", "none");

  });

$('.multi').multi_select({
  selectColor: 'red',
  selectSize: 'big',
  selectText: 'Select all that apply',
  duration: 300,
  easing: 'slide',
  listMaxHeight: 200,
  selectedCount: 2,
  sortByText: true,
  fillButton: true,
  data: {
      <?php
      foreach ($list as $value) {
        $value = (array) $value;
        $name =  $value['name'];
        $id = $value['id'];
        ?>
    "<?php echo $id; ?>": "<?php echo $name; ?>",

<?php } ?>
  },
  onSelect: function(values) {
    $(".confide").val(values);

    //console.log('return values: ', values);
  },
  });


  </script>
