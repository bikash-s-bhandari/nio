<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Content Management
            
          </h1>
          <ol class="breadcrumb">
          <?php foreach($breadcrumb as $key => $value):?>
            <?php if($value==''):  ?>
            <li class="active"><?= ucfirst($key);?></li>

            <?php else:  ?>
          <li><a href="<?php echo base_url();?>admin/<?php echo $value;?>"><?= ucfirst($key);?></a></li>;
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
                <?php echo $form;  ?>

               <!--  <div class="form-group">
                <label for="long_description">Long Description <span class="required" style="display: block;float: right">*</span> </label>
                <textarea rows="7" name="long_description" class="form-control" id="long_description" placeholder="Long Description"></textarea>
            </div> -->
                
              </div><!-- /.box -->

              

              

             


            </div><!--/.col (left) -->
            <!-- right column -->
            
          </div>   <!-- /.row -->
        </section><!-- /.content -->
 </div><!-- /.content-wrapper -->

 <?php if($form_id=='registar'): ?>
  <script>
 
    window.onload = function() {
       load_ckeditor('r_message',true);
       };
</script>  
<?php elseif($form_id=='news'): ?>
<script>
    window.onload = function() {
     //  load_ckeditor('notice_content');
        load_ckeditor('news_content');
    };
</script>   

<?php elseif($form_id=='notice'): ?>

<script>
    window.onload = function() {
    load_ckeditor('notice_content');
        
    };
</script>   


  <?php elseif($form_id=='intro'):  ?>
<script>
    window.onload = function() {
    load_ckeditor('site_introduction',true);
        
    };
</script>   
    <?php  elseif($form_id=='page'):?>
    <script>
  
    window.onload = function() {
    load_ckeditor('page_content');
        
    };
</script>

<?php elseif($form_id=='nav_group'): ?>
  <script>
    window.onload = function() {
    load_ckeditor('nav_group',true);
        
    };
</script>   
<?php endif; ?>
      