

<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Reply To Message

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
             <?= $this->session->flashdata('success'); ?>
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
                  <form class="form-horizontal" action="<?php echo base_url().$action; ?>" method="post">
                    <fieldset>
                      <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                  
                      <div class="control-group">
                      <label class="control-label" for="typeahead">Message</label>
                      <br/>
                      <div class="controls">
                      <textarea class="cleditor" id="u_msg" rows="3" class="form-control" name="message"><?php set_value('message') ; ?></textarea>
                      <?php echo form_error('message', '<span style="color:red">', '</span>');?>
                      
                      </div>
                    </div>
                    <br/>
                      <div class="form-actions">
                      <input type="submit" class="btn btn-primary" name="submit" value="Send">
                      <a href="<?php echo base_url('admin/message');?>" class="btn btn-default" >Cancel</a>
                     
                    </div>
                    </fieldset>
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

       load_ckeditor('u_msg',true);
      

    };
</script>