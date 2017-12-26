<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Ambassador Message
            
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
          <?php if($this->session->flashdata('success')):    ?>
            <div class=" col-sm-offset-0 col-sm-12">
                     
             <center><div id="success" class="alert alert-success"><?= $this->session->flashdata('success'); ?></div></center>
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
               <form action="<?php echo base_url('admin/ambassador_message');?>" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control"  name="name" value="<?= $message->name; ?>" placeholder="Enter Name">
                    </div>
                   
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1">Message</label>
                      <textarea id="ambassador_msg" name="message" class="form-control"><?= $message->message; ?></textarea>
                     
                    </div>
                    <div class="form-group">
                      <label for="" style="display: block;">Image</label>

            <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
             
            <img src="<?php echo base_url('uploads').'/ambassador_image/thumbs/'.$message->image; ?>">
                          
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
                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                </form>
             
              
                
              </div><!-- /.box -->

              

              

             


            </div><!--/.col (left) -->
            <!-- right column -->
            
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
       <script>
    window.onload = function() {
    load_ckeditor('ambassador_msg',true);
        
    };
</script>