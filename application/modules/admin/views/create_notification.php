<?php $isEdit=isset($datas)? TRUE:FALSE;    ?>

<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Notification Management
            
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
                <form id="create_notice" action="<?php echo base_url().$action; ?>" method="post">
                    
                  
                    <div class="form-group">
                      <label for="Title">Title</label>
                      <input type="text" class="form-control" name="title" value="<?php  if($isEdit) echo $datas->title;?>"  placeholder="Title" required>
                      <span style="color:red"><?php echo form_error('title'); ?></span>
                    </div>
                    <div class="form-group">
                      <label for="Description">Message</label>
                      <textarea class="form-control" id="notification" rows="3" name="message"  placeholder="Message here." required><?php if($isEdit) echo $datas->message; ?></textarea>
                      <span style="color:red"><?php echo form_error('message'); ?></span>
                    </div>
                      
                  <div class="box-footer">
                    <?php  if($isEdit): ?>
                      <button type="submit" class="btn btn-primary">Update</button>
                    <?php else: ?>
                    <button type="submit" class="btn btn-primary">Send Now</button>
                  <?php endif; ?>
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

       load_ckeditor('notification',true);
      

    };
</script>