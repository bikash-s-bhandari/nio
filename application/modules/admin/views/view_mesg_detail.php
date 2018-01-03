
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Message
            <small>Management</small>
          </h1>
         
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                   <div><a href="<?= base_url('admin/message/reply_message/'.$uid); ?>" class="btn btn-primary">Reply To This Message</a></div>
                    <br/>
                  <h3 class="box-title"><?= $table_name; ?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="" method="post" id="page_create">
                 
                  <div class="box-body">
                    <table class="table table-striped">
              
                <tbody>
                 
              <tr>
               
              <td style="font-weight: bold;">Date Sent</td>

              <td><?= get_nice_date($user_info->created_at,'full'); ?></td>
              </tr>
              <tr>
              <td style="font-weight: bold;">Sent By</td>
              <td><?= $user_info->full_name; ?></td>
              </tr>
              <tr>
              <td style="font-weight: bold;">Email Address</td>
              <td><?= $user_info->email; ?></td>
              </tr>
               <tr>
              <td style="font-weight: bold;">Address</td>
              <td><?= $user_info->address; ?></td>
              </tr>
              <tr>
              <td style="font-weight: bold;">Subject</td>
              <td><?= $user_info->subject; ?></td>
              </tr>
              <tr>
              <td style="font-weight: bold; vertical-align: top;">Message</td>
              <td style="vertical-align: top;"><?= nl2br($user_info->message); ?></td>
            </tr>
                

              
     
              
          </tbody>
        </table>   
                    

                   
                    
                  </div><!-- /.box-body -->

                  
           
                 </form>
             
              </div><!-- /.box -->
              

              
              
            </div><!-- /.col-->
          </div><!-- ./row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
 