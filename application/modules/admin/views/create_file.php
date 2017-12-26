<?php $isEdit=isset($datas)? TRUE:FALSE;  ?>

<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            File Management
            
          </h1>
          <ol class="breadcrumb">
          <?php foreach($breadcrumb as $key => $value):?>
            <?php if($value==''):  ?>
            <li class="active"><?= ucfirst($key);?></li>

            <?php else:  ?>
          <li><a href="<?php echo base_url('admin')?>/<?php echo $value;?>"><?= ucfirst($key)?></a></li>
          <?php endif; endforeach; ?>
            
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
                  <h3 class="box-title"><?= $table_name; ?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->

                <div class="box-body">
                <form action="<?php echo base_url().$action; ?>" method="post" enctype="multipart/form-data">
                    
                            <?php if ($isEdit) { ?> 
                                <input type="hidden" value="<?php echo $datas->filename; ?>" name="prev_file"/>
                            <?php } ?>
                    <div class="form-group">
                      <label for="Title">Title</label>
                      <input type="text" class="form-control" name="title" value="<?php if($isEdit) echo $datas->title; ?>" id="exampleInputEmail1" placeholder="Title" required>
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

 <!--  <script>
 
    window.onload = function() {
       load_ckeditor('r_message',true);
       };
</script>  
 -->