<?php $isEdit=isset($datas)? TRUE:FALSE;    ?>

  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Landmark Management

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
            $attributes = array('id' => 'create_landmark');
             echo form_open($action,$attributes); 
             ?>
                  <div class="box-body">
                     <div class="form-group">
                      <label for="exampleInputEmail1">Category</label>
                      <div class="row">
                        <div class="col-md-6">
                      <?php 
                         $js='class="form-control" required';
                         
                         echo form_dropdown('cat_id',$options,$cat_id,$js);
                       ?>
                     </div>
                     </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Title</label>
                      <input type="text" name="title" value="<?php if($isEdit) echo $datas->title;  ?>" class="form-control" placeholder="Landmark Title" required>
                      <span style="color:red"><?php echo form_error('title'); ?></span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="email" name="email" required value="<?php if($isEdit) echo $datas->email;  ?>" class="form-control" placeholder="Email Address">
                      <span style="color:red"><?php echo form_error('email'); ?></span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Address</label>
                      <input type="text" name="address" value="<?php if($isEdit) echo $datas->address;  ?>" class="form-control" id="pac-input" placeholder="Address" required>
                      <span style="color:red"><?php echo form_error('address'); ?></span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Website</label>
                      <input type="text" name="website" value="<?php if($isEdit) echo $datas->website;  ?>" class="form-control"  placeholder="Website URL">
                       
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
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                  
                <?php echo form_close();  ?>
              </div><!-- /.box -->

              

              

            </div><!--/.col (left) -->
            <!-- right column -->

          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
 