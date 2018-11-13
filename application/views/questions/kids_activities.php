<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Kids Extracurricular Activities", "txt3" => "")); ?>
    <div class="container form-margin">
        <?php
        echo form_open(base_url('save-kids-activities-info'), array("METHOD"=>"POST"));
        ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php
                $this->load->view('shared/_bar', array('percentage'=>$percentage, 'level'=>3));
                echo Smart::softErrors();
                echo Smart::formErrors();
                ?>
                <div id="register-form" class="register-form">
                    <div>
                    <h5>Life Decision : <?php echo $this->session->userdata('life_decision'); ?></h5>
                    <hr>
                  </div>
                    <div class="section-field">
    
                        <label><?php echo $this->labelArray['kids_activities'];?></label>

                     <!--    <div class="field-widget remember-checkbox">
                            <?php echo Smart::checkListSmart('kids_activities[]', $list, 'name', 'name', explode(",", $app->kids_activities))?>
                        </div> -->
            




                        

                    </div> 
                    <div class="input-group">
                       <div class="multi" id="multi" style="height: 50px;"></div>

                       <div class="input-group-btn help-select-list"> 
                            <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content="Extracurricular means paid activities like sports, music, special needs, etc"><i class="fa fa-2x fa-question-circle"></i></button>
                        </div>
                </div>
                    <br>
                    <div class="section-field">
                        <label><?php echo $this->labelArray['activities_cost'];?></label>
                        <div class ='field-widget'>
                            <input type="number" min="0" step="500" class="web form-control" required="required"  
                            autocomplete="off" name="activities_cost"  value="<?php echo Smart::setValue('activities_cost', $app->activities_cost); ?>"
                            data-message="<?php echo lang('req_kids_activites_cost') ?>" style="height: 48px;">
                            <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content=""><i class="fa fa-2x fa-question-circle"></i></button>
                            </div>
                        </div>
                    </div>

                      <input type="hidden" name="kids_activities" class="kids_activities">
                </div>
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
  selectText: 'What extracurricular activities are your kids currently in',
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
    $(".kids_activities").val(values);

    //console.log('return values: ', values);
  },
  });


  </script>
