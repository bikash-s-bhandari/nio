<!DOCTYPE html>
<html>
<head>
	<title>Currency Converter</title>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" type="text/css" />
	<style type="text/css">
		
		.main-panel
		{
			margin-top: 200px;
		}

		div.row
		{
			padding: 10px;
		}

		.header
		{
			background-color:darkblue;
			color: #FFF;
			font-weight: bold;
		}
		.panel
		{
			border-color: darkblue;
		}
	</style>
	


</head>
<body onload="loadCurrencies()">

<div class="container main-panel">
	<div class="col-md-offset-4 col-md-4 panel">
		<div class="row header">
			Currency Converter
		</div>
		<div class="row">
			<div class="col-md-2">Amount</div>
		    <div class="col-md-10">
		    	<input type="text" oninput="convertCurrency()" class="form-control" id="amount">
		    </div>
		</div>
		<div class="row">
			<div class="col-md-2">From:</div>
			<div class="col-md-2"><select onchange="convertCurrency()" id="from"></select></div>
			<div class="col-md-2">To:</div>
			<div class="col-md-2"><select onchange="convertCurrency()" id="to"></select></div>
		  
		</div>
		<div class="row">
			Result:<span id="result"></span>

		</div>
	</div>


</div>




<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">


		function loadCurrencies()
		{


			var from=document.getElementById('from');
			var to=document.getElementById('to');
			var xHttp=new XMLHttpRequest();
			xHttp.onreadystatechange=function()
			{
				if(xHttp.readyState==4 && xHttp.status==200)
				{

					var obj=JSON.parse(this.responseText);

					var options='';
					for(key in obj.rates)
					{
						
						options=options+'<option>'+key+'</option>';
					}

					from.innerHTML=options;
					to.innerHTML=options;
				}
			}
			xHttp.open('GET','https://api.fixer.io/latest',true);
			xHttp.send();

		}


		function convertCurrency()
		{


			var from=document.getElementById('from').value;
			var to =document.getElementById('to').value;
			var amount=document.getElementById('amount').value;

			var result=document.getElementById('result');
			// console.log("from"+from.length);
			// console.log("amount"+amount.length);
			// console.log("to"+to.length);

			if(from.length>0 && to.length>0 && amount.length>0)
			{
				console.log(from.length);

				var xHttp=new XMLHttpRequest();
				xHttp.onreadystatechange=function()
			    {
				if(xHttp.readyState==4 && xHttp.status==200)
				{

					var obj=JSON.parse(this.responseText);
					var fact=obj.rates[to];
					if(fact!=undefined)
					{
						result.innerHTML=parseFloat(amount)*parseFloat(fact);
					}

					

					
				}
			  }
				xHttp.open('GET','https://api.fixer.io/latest?base='+from+'&symbols='+to,true);
				xHttp.send();
			}
		}


	
	

</script>
</body>
</html>