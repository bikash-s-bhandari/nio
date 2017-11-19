<?php $isEdit=isset($datas)? TRUE:FALSE;    ?>

<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            News Management
            
          </h1>
          <ol class="breadcrumb">
          <?php foreach($breadcrumb as $key => $value):?>
            <?php if($value==''):  ?>
            <li class="active"><?= ucfirst($key);?></li>

            <?php else:  ?>
          <li><a href="<?php echo base_url('admin')?>/<?php echo $value;?>"><?= ucfirst($key);?></a></li>
          <?php endif; endforeach; ?>
            
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
          <?php if($this->session->flashdata('success')):    ?>
            <div class=" col-sm-offset-0 col-sm-12">
            <center>
             <div id="success" class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
             </center>
           </div> 
              
           
            
          <?php endif; ?>
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?= $table_name; ?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->

                <div class="box-body">
                <form id="create_news" action="<?php echo base_url().$action; ?>" method="post" enctype="multipart/form-data">
                    
                  
                    <div class="form-group">
                      <label for="Title">Title</label>
                      <input type="text" class="form-control" name="title" value="<?php  if($isEdit) echo $datas->title;?>"  placeholder="Title" required>
                      <span style="color:red"><?php echo form_error('title'); ?></span>
                    </div>
                    <div class="form-group">
                      <label for="Title">Slug</label>
                      <input type="text" class="form-control" name="slug" value="<?php if($isEdit) echo $datas->slug; ?>"  placeholder="Slug">
                      <p class="help-block">Leave blank to auto create slug. </p>
                      
                    </div>
                    <div class="form-group">
                      <label for="Title">Sub Title</label>
                      <input type="text" class="form-control" name="sub_title" value="<?php if($isEdit) echo $datas->sub_title; ?>"  placeholder="Sub Title">
                      
                    </div>
                    <div class="form-group">
                      <label for="Title">Category</label>
                      <div class="row">
                        <div class="col-md-4">
                      <?php 
                       $js ='id="parent_cat" onChange="getSubCat(this.value);" class="form-control" required';
                         
                         echo form_dropdown('cat_id',$options,$cat_id,$js);
                       ?>

                     </div>
                     </div>
                     <span style="color:red"><?php echo form_error('cat_id'); ?></span>
                    </div>

                     <div class="form-group" id="subcat">
                      <?php if($isEdit) {?>
                      <input type="hidden" name="sub_cat_id" value="<?= $datas->sub_cat_id; ?>" id="sub_cat">

                      <?php } ?>
                     
                    </div>


                    <div class="form-group">
                      <label for="Title">Author</label>
                      <input type="text" class="form-control" name="author" value="<?php if($isEdit) echo $datas->author; ?>"  placeholder="Author Name" required>
                      <span style="color:red"><?php echo form_error('author'); ?></span>
                    </div>
                    <div class="form-group">
                      <label for="Description">Contents</label>
                      <textarea class="form-control" id="content" rows="3" name="content"  placeholder="Description" required><?php if($isEdit) echo $datas->content; ?></textarea>
                      <span style="color:red"><?php echo form_error('content'); ?></span>
                    </div>

                    <div class="form-group">
                      <label for="Description">Publish Date</label>
                      <input type="text" class="form-control" name="publish_date" value="<?php if($isEdit) echo $datas->publish_date; ?>"  placeholder="yyyy-mm-dd" id="newsDate" required>
                      <span style="color:red"><?php echo form_error('publish_date'); ?></span>
                     
                    </div>

                    <div class="form-group">
                      <label>Publish</label>
                      <div class="switch has-switch ios checked">
                                        <div class="switch-on switch-animate">
                                        <input type="checkbox" name="status" value="publish" 
                                        <?php
                                         if($isEdit) 
                                        {
                                          if($datas->status=='publish')
                                          {
                                            echo 'checked'; 

                                          }
                                        
                                          

                                        }
                                        else
                                        {
                                          echo 'checked';
                                        }
                                        ?> >
                                        <span class="switch-left"></span>
                                        <label class="normal">&nbsp;</label><span class="switch-right"></span>
                                        </div>
                                    </div>
                    </div>


                   
                    
                    
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                    </form>
                     </div>
                    
                  </div>


                <!--form close-->
                

            </div><!--/.col (left) -->
            <!-- right column -->
            
          </div>   <!-- /.row -->
        </section><!-- /.content -->
 </div><!-- /.content-wrapper -->




 <script>
 window.onload = function () {

       load_ckeditor('content');
      

    };
</script>