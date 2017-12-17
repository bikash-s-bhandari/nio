<?php $isEdit=isset($datas)? TRUE:FALSE;    ?>
 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Event Management

        </h1>
          <ol class="breadcrumb">
          <?php foreach ($breadcrumb as $key => $value)
          {
            if($value==''):
              echo '<li class="active">'.ucfirst($key).'</li>';

              else:
              echo '<li><a href="'.base_url().'admin/'.$value.'">'.ucfirst($key).'</a></li>';

             endif;
           } ?>
            
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?=$table_name; ?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
            <?php 
            $attributes = array('id' => 'create_event','enctype'=>"multipart/form-data");
             echo form_open($action,$attributes); 
             ?>
                  <div class="box-body">
                     
                    <div class="form-group">
                      <label for="exampleInputEmail1">Title</label>
                      <input type="text" name="name" value="<?php if($isEdit) echo $datas->name;  ?>" class="form-control" placeholder="Enter Event Title" required>
                      <span style="color:red"><?php echo form_error('name'); ?></span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="email" name="email" value="<?php if($isEdit) echo $datas->email;  ?>" class="form-control" placeholder="Enter Email Address">
                      <span style="color:red"><?php echo form_error('email'); ?></span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Phone</label>
                      <input type="tel" name="phone" value="<?php if($isEdit) echo $datas->phone;  ?>" class="form-control" placeholder="Enter Contact Number" required>
                      <span style="color:red"><?php echo form_error('phone'); ?></span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Address</label>
                      <input type="text" name="address" value="<?php if($isEdit) echo $datas->address;  ?>" class="form-control" placeholder="Enter Address" required>
                      <span style="color:red"><?php echo form_error('address'); ?></span>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                      <label for="exampleInputEmail1">Start Date</label>
                      <input type="text" id="start_date" name="start_date" value="<?php if($isEdit) echo $datas->start_date;  ?>" class="form-control" placeholder="YYYY-MM-DD" required>
                      <span style="color:red"><?php echo form_error('start_date'); ?></span>
                    </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                      <label for="exampleInputEmail1">End Date</label>
                      <input type="text" id="end_date" name="end_date" value="<?php if($isEdit) echo $datas->end_date;  ?>" class="form-control" placeholder="YYYY-MM-DD" required>
                      <span style="color:red"><?php echo form_error('end_date'); ?></span>
                    </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                         
                      <label for="start_time">Start Time</label>
                       <div class="input-group bootstrap-timepicker">
                      <input type="text" name="start_time" value="<?php if($isEdit) echo $datas->start_time;  ?>" class="form-control start_time" placeholder="HH:MM" required>
                       <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                      </div>
                      <span style="color:red"><?php echo form_error('start_time'); ?></span>
                    </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                      <label for="exampleInputEmail1">End Time</label>
                      <div class="input-group bootstrap-timepicker">
                      <input type="text" name="end_time" value="<?php if($isEdit) echo $datas->end_time;  ?>" class="form-control end_time" placeholder="HH:MM" required>
                       <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                    </div>
                      <span style="color:red"><?php echo form_error('end_time'); ?></span>
                    </div>
                      </div>
                    </div>
                   
                    <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                     <textarea name="description" class="form-control" id="event_description"><?php if($isEdit){ echo $datas->description;}  ?></textarea>
                      <span style="color:red"><?php echo form_error('description'); ?></span>
                    </div>
                   
                   
                  <div class="form-group">
                   <label for="image" style="display:block;">Image</label>
                    <?php if ($isEdit) { ?>
                                <input type="hidden" value="<?php echo $datas->image; ?>" name="prev_image"/>
                            <?php } ?>

                    <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                     
                    <?php if($isEdit):   ?>
                      <img src="<?php echo base_url().'uploads/'.'news_events/'.$datas->image; ?>">
                    <?php endif; ?>   
                                  
                    </div>
                  <div>
                    <span class="btn default btn-file">
                    <span class="fileinput-new">
                    Select image </span>
                    <span class="fileinput-exists">
                    Change </span>
                    <input type="file" name="userfile">
                    </span>
                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">
                    Remove </a>
                  </div>
                </div>
              </div>
         
               <div class="form-group">
                      <label>Status</label>
                     <div class="form-group">
                      <div class="radio">
                        <label>
                          <input type="radio" name="status" id="optionsRadios1" value="1"
                          <?php
                              if($isEdit) 
                                       {
                                          if($datas->status==1)
                                          {
                                            echo 'checked'; 

                                          }
                                        
                                        }
                                        else
                                        {
                                          echo 'checked';
                                        }
                                        ?>
                                        >
                          Active
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="status" id="optionsRadios2" value="0"
                          <?php
                              if($isEdit) 
                                       {
                                          if($datas->status==0)
                                          {
                                            echo 'checked'; 

                                          }
                                        
                                        }
                                        
                                        ?>


                          >
                          In Active
                        </label>
                      </div>
                      
                    </div>
                    </div>

                    </div>
                    <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                       
                  </div><!-- /.box-body -->

                  
                  
                <?php echo form_close();  ?>
              </div><!-- /.box -->

              

              

            </div><!--/.col (left) -->
            <!-- right column -->

         
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
 <script>
    window.onload = function() {
    load_ckeditor('event_description',true);
        
    };
</script>   
    