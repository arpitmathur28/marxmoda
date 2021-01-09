<!DOCTYPE html>
<html lang="en">
<head>
  <title>MarxModa Payment</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
	.successHeader{ 
		background: linear-gradient(to right, #0196d9 0%, #0075bf 100%); 
		color:#fff;
		min-height:100px;
		padding-bottom: 20px;
		border-radius:8px 8px 0 0 ;
	}
	.payMentCard{ 
		margin-top:100px;
		/*border:1px solid #e1e7eb;*/
		border-radius:8px;
		box-shadow:0 0 5px 0 gray;
	}
	.topLabel{ 
		margin-bottom:0px;
		font-size:15px;
		margin-right: 6px;
	}	
	.cardBody{
		/*min-height:200px;*/  
	}
	.okIcon{
		margin-top:40px;
	}
	.backBtn{
		background:#c7c7c7;
		color:gray;
		border-radius:20px;
	}
	.logoFooter{
		height:15px;
		width:15px;
	}
	.footer{
		background: linear-gradient(to right, #0196d9 0%, #0075bf 100%);
		min-height:50px;
		margin-top:40px!important;
		border-radius: 0 0 8px 8px!important;
		padding-top: 10px;
	}
	.row{
		margin-left: 0px;
		margin-right: 0px;
	}
	.leftcol{
		width: 30%;
	}
  </style>
</head>
<body> 
 
<div class="container">
  <div class="row justify-content-center">
	<div class="col-md-5">
		<div class="row payMentCard">
			<div class="col-md-12 p-0">
				<div class="successHeader">
					<div class="row">
						<div class="col-md-12 text-center">
							<img src="{{url('public/images/cancelIcon.png')}}" class="okIcon">
						</div>
						<div class="col-md-12 text-center">
							<h4><b>Payment Failed!</b></h4>
						</div>
						<div class="col-md-12 text-center">
							<!--<label class="text-muted">Your Payment information has been sent in your mail</label>-->
						</div>				
					</div>
				</div>
				<div class="cardBody">
					<div class="row">
						<div class="col-md-6">
							<h5><label class="topLabel"></label></h5>
						</div>
						<div class="col-md-6 text-right">
							
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							
						</div>
					</div>
					
					<div class="row footer m-0">
							<div class="col-md-6 text-left">
									<p class="pt-2" style="font-size: 12px; margin-bottom: 0px!important;"><i class="fa fa-lock" aria-hidden="true" style="color: #00FF00; font-size: 16px;"></i> Secure payments with PayPal</p>
							</div>
							<div class="col-md-6 text-right">	
									<p><img src="{{url('public/images/logo.svg')}}" width="50%"></p>
							</div>
					</div>
				</div>
			</div>
		</div>		
	</div>
  </div>
</div>

</body>
</html>
