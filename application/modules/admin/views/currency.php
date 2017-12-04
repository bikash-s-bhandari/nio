<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Currency Converter

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
             <div class="container main-panel">
         <form action="" method="post" id="convert-form">
		<div class="col-md-offset-2 col-md-6 panel">
		<div class="row header">
			Currency Converter
		</div>
		<div class="row">
			<div class="col-md-2">From:</div>
			<div class="col-md-4">
				<select id="from" class="form-control" name="from">
					<option value="OMR">Omani rial</option>
					<option value="NPR">Neplease Rupee</option>
					
				</select>
			</div>
			<div class="col-md-2">To:</div>
			<div class="col-md-4">
				<select id="to" class="form-control" name="to" >
					<option value="NPR">Neplease Rupee</option>
					<option value="OMR">Omani rial</option>
				</select>
			</div>
		  
		</div>
		<div class="row">
			<div class="col-md-2">Amount</div>
		    <div class="col-md-10">
		    	<input type="text" class="form-control" id="amount">
		    </div>
		</div>
		
		<div class="row">
			<div class="col-md-2"><strong>Result</strong></div>
		    <div class="col-md-10">
		    	<input type="text" class="form-control" value="" id="result" readonly="readonly">
		    </div>

		</div>
		<div class="form-group">
			<button type="submit" id="convert" class="btn btn-info">Convert</button>
		</div>
	</div>
</form>
	</div>


</div>

              

              

            </div><!--/.col (left) -->
            <!-- right column -->

         
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
 




