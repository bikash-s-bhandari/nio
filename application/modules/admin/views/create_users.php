<?php $isEdit=isset($datas)? TRUE:FALSE;    ?>

  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           User Management

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
            $attributes = array('id' => 'create_user');
             echo form_open($action,$attributes); 
             ?>
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">First Name</label>
                      <input type="text" name="fname" value="<?php if($isEdit) echo $datas->fname;  ?>" class="form-control" placeholder="Firstname" required>
                      
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Last Name</label>
                      <input type="text" name="lname" value="<?php if($isEdit) echo $datas->lname;  ?>" class="form-control" placeholder="Lastname" required>
                     
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Username</label>
                      <input type="text" name="username" value="<?php if($isEdit) echo $datas->username;  ?>" class="form-control" placeholder="Username">
                     
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="email" name="email" required value="<?php if($isEdit) echo $datas->email;  ?>" class="form-control" placeholder="Email Address">
                      
                    </div>
                     <?php if(!$isEdit){  ?>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Password</label>
                      <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <?php } ?>

                   <div class="form-group">
                      <label>Status</label>
                     <div class="form-group">
                      <div class="radio">
                        <label>
                          <input type="radio" name="status" id="optionsRadios1" value="1"
                          <?php
                              if($isEdit){
                                          if($datas->status==1)
                                          {
                                            echo 'checked';
                                          }}
                                        else
                                        {
                                          echo 'checked';
                                        }
                                        ?>
                                        >Active
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="status" id="optionsRadios2" value="0"
                          <?php
                              if($isEdit) 
                                       {if($datas->status==0)
                                          {
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
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                  
                <?php echo form_close();  ?>
              </div><!-- /.box -->

              

              

            </div><!--/.col (left) -->
            <!-- right column -->

          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
 