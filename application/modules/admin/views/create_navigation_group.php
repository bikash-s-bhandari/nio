<?php $isEdit=isset($datas)? TRUE:FALSE;    ?>
 <div class="content-wrapper">
       <section class="content-header">
          <h1>
           Page Management

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
                  $attributes = array('id' => 'page_group');  
                 echo form_open($action,$attributes); 
                 ?>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Title</label>
                      <input type="text" name="title" value="<?php if($isEdit) echo $datas->title;  ?>" class="form-control" id="" placeholder="Group Title" required>
                     
                  </div>

                  <div class="form-group">
                      <label for="exampleInputEmail1">Slug</label>
                      <input type="text" name="abbrev" value="<?php if($isEdit) echo $datas->abbrev;  ?>" class="form-control" id="" placeholder="Slug">
                      
                  </div>

                  <div class="form-group">
                      <label for="exampleInputEmail1">Priority</label>
                      <input type="text" name="priority" value="<?php if($isEdit) echo $datas->priority;  ?>" class="form-control" id="" placeholder="Priority">
                      
                  </div>
                   
                    </div>
                        <div class="form-group">
                      <label>Status</label>
                     <div class="form-group">
                      <div class="radio">
                        <label>
                          <input type="radio" name="status" id="optionsRadios1" value="1"
                          <?php
                              if($isEdit) {if($datas->status==1){ echo 'checked'; }}
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
                              if($isEdit) { if($datas->status==0)
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
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
 