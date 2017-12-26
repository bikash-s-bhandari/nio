<?php $isEdit=isset($datas)? TRUE:FALSE;    ?>
 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Press Management

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
            <?php if($this->session->flashdata('errors')):    ?>
            <div class=" col-sm-offset-0 col-sm-12">
            <center>
             <div class="alert alert-warning"><?= $this->session->flashdata('errors'); ?></div>
             </center>
           </div> 
          <?php endif; ?>
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?=$table_name; ?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
            <?php 
            $attributes = array('id' => 'create_press_realese','enctype'=>"multipart/form-data");
             echo form_open($action,$attributes); 
             ?>
              <?php if ($isEdit) { ?> 
                                <input type="hidden" value="<?php echo $datas->filename; ?>" name="prev_file"/>
                            <?php } ?>
                  <div class="box-body">
                     <div class="form-group">
                      <label for="exampleInputEmail1">Title</label>
                      <input type="text" name="title" value="<?php if($isEdit) echo $datas->title;  ?>" class="form-control" placeholder="Title" required>
                      <span style="color:red"><?php echo form_error('title'); ?></span>
                    </div>
                   
                    <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                     <textarea name="description" class="form-control" id="press_description" required><?php if($isEdit){ echo $datas->description;}  ?></textarea>
                      <span style="color:red"><?php echo form_error('description'); ?></span>
                    </div>
                   
                   
                   <div class="form-group">

                      <?php if($isEdit):   ?>
                      <label for="exampleInputFile">Upload File</label>
                      <input type="file" id="InputFile" class="form-control" name="userfile"><span><?php if($isEdit) echo $datas->filename; ?></span>
                      <p class="help-block">Maximum Upload Size(8MB)</p>

                    <?php  else: ?>
                    <label for="exampleInputFile">Upload File</label>
                      <input type="file" id="InputFile" class="form-control" name="userfile" required>
                      <p class="help-block">Maximum Upload Size(8MB)</p>
                    <?php  endif; ?>
                </div>
                 <div class="form-group">
                      <label for="exampleInputEmail1">Publish Date</label>
                      <input type="text" id="press_publish_date" name="publish_at" value="<?php if($isEdit) echo $datas->publish_at;  ?>" class="form-control" placeholder="YYYY-MM-DD" required>
                      <span style="color:red"><?php echo form_error('publish_at'); ?></span>
                  </div>
         
               <div class="form-group">
                      <label>Status</label>
                     <div class="form-group">
                      <div class="radio">
                        <label>
                          <input type="radio" name="status" id="optionsRadios1" value="1"
                          <?php
                              if($isEdit) { if($datas->status==1)
                                          {echo 'checked'; }
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
                              if($isEdit) {if($datas->status==0){
                                            echo 'checked';
                                          } 
                                        }
                                        
                                        ?>>
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
    load_ckeditor('press_description',true);
        
    };
</script>   
    