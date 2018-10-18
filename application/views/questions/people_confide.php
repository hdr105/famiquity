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
                    <div class="section-field">
                        <label><?php echo $this->labelArray['confide'];?></label>
                        <div class="field-widget remember-checkbox">
                            <!-- <?php echo Smart::checkListSmart('confide[]', $list, 'id', 'name', explode(",", $app->confide))?>  -->
                            <!-- junaid -->
                             <div class="multi" id="multi"></div>


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

$('.multi').multi_select({
  selectColor: 'red',
  selectSize: 'small',
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
  // $('#save').on('click', function(event) {
  //           console.log($('#multi').multi_select('getSelectedValues'));
  //   var json = { items: $('#multi').multi_select('getSelectedValues') };
  //   if (json.items.length) {
  //       console.log(json.items);

  //     $(json.items).each(function(index, item) {
  //       ul.append(
  //         '<li style="display: block;">' + item + '</li>'
  //       );
  //     });
  //   }
  // })

  </script>