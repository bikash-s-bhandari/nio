<?php $isEdit=isset($datas)? TRUE:FALSE;    ?>

<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Notice Management
            
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
                <form id="create_notice" action="<?php echo base_url().$action; ?>" method="post" enctype="multipart/form-data">
                    
                  
                    <div class="form-group">
                      <label for="Title">Title</label>
                      <input type="text" class="form-control" name="title" value="<?php  if($isEdit) echo $datas->title;?>"  placeholder="Title" required>
                      <span style="color:red"><?php echo form_error('title'); ?></span>
                    </div>
                    <div class="form-group">
                      <label for="Description">Contents</label>
                      <textarea class="form-control" id="notice" rows="3" name="content"  placeholder="Notice here." required><?php if($isEdit) echo $datas->content; ?></textarea>
                      <span style="color:red"><?php echo form_error('content'); ?></span>
                    </div>
                      <div class="form-group">
                      <label for="exampleInputEmail1" style="display: block;">Image</label>
                      <?php if ($isEdit) { ?>
                                          <input type="hidden" value="<?php echo $datas->image; ?>" name="prev_image"/>
                                      <?php } ?>

                      <div class="fileinput fileinput-new" data-provides="fileinput">
                      <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                       
                     <?php if($isEdit):
                    $url=base_url().'uploads/';
                    ?>
                      <img src="<?php if($datas->image==''){echo $url.'no-image.jpeg';}else { echo $url.'notice/thumbs/'.$datas->image;} ?>">
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
                              if($isEdit) {if($datas->status==1)
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

       load_ckeditor('notice',true);
      

    };
</script>