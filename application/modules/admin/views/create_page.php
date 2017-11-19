<?php $isEdit=isset($datas)? TRUE:FALSE;    ?>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Page
            <small>Management</small>
          </h1>
           <ol class="breadcrumb">
          <?php foreach($breadcrumb as $key => $value):?>
            <?php if($value==''):  ?>
            <li class="active"><?= ucfirst($key);?></li>

            <?php else:  ?>
          <li><a href="<?php echo base_url();?>admin/<?php echo $value;?>"><?= ucfirst($key);?></a></li>
          <?php endif; endforeach; ?>
            
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?= $table_name; ?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="<?php echo base_url().$action; ?>" method="post" id="page_create">
                 
                  <div class="box-body">
                    <div class="col-md-6">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Page Title</label>
                      <input type="text" class="form-control" id="" placeholder="Enter Title" name="title" value="<?php if($isEdit) echo $datas->title;  ?>" required>
                      
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Slug</label>
                      <input type="text" class="form-control" id="" placeholder="Slug" name="slug" value="<?php if($isEdit) echo $datas->slug;  ?>">
                       <p class="help-block">Leave blank to auto create slug. </p>
                     
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Category</label>
                      <div class="row">
                        <div class="col-md-6">
                      <?php 
                         $js='class="form-control" required';
                         
                         echo form_dropdown('nav_id',$options,$nav_id,$js);
                       ?>
                     </div>
                     </div>
                    </div>
                      <div class="form-group">
                      <label>Status</label>
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
                              if($isEdit) { if($datas->status==0){
                                            echo 'checked'; }
                                        }
                                        
                                        ?>
                                        >
                          In Active
                        </label>
                      </div>
                      
                    
                    </div>
                      
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                      <label for="image">Image Link</label>
                      <input type="text" class="form-control" id="" placeholder="Image URL" name="image_link" value="<?php if($isEdit) echo $datas->image_link;  ?>">
                     
                    </div>

                     <div class="form-group">
                      <label for="image">Meta Title</label>
                      <input type="text" class="form-control" id="" placeholder="Image URL" name="meta_title" value="<?php if($isEdit) echo $datas->meta_title;  ?>">
                     
                    </div>
                    <div class="form-group">
                      <label for="image">Meta keywords</label>
                      <input type="text" class="form-control" id="" placeholder="Image URL" name="meta_keywords" value="<?php if($isEdit) echo $datas->meta_keywords;  ?>">
                     
                    </div>

                    <div class="form-group">
                      <label for="image">Meta Description</label>
                      <textarea name="meta_description" class="form-control" placeholder="Description here.."><?php if($isEdit) echo $datas->meta_description;  ?></textarea>
                     
                    </div>
                    
                    
                   
                    </div>


                   
                    
                  </div><!-- /.box-body -->

                <div class="box-header">
                  
                  
                </div><!-- /.box-header -->
                <div class="box-body pad">
                  
                    <textarea  class="textarea" name="content" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required><?php if($isEdit) echo $datas->content;  ?></textarea>
                     
                  
                </div>
                 <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                 </form>
             
              </div><!-- /.box -->
              

              
              
            </div><!-- /.col-->
          </div><!-- ./row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
 