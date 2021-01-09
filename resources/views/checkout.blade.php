<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

	<title>MarxModa Payment</title>
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	
	<link href="{{ URL::asset('resources/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('resources/css/success-style.css') }}" rel="stylesheet">
	<style>
		.bg-white{
			background:#fff;
			box-shadow:0 0 5px 0 gray;
			border-radius: 8px;
		}
		body{
			background:#f5f5f5;
		}
		.topHeader{
			background: linear-gradient(to right, #0196d9 0%, #0075bf 100%); 
			color:#fff;
			padding:30px;
			border-radius: 8px 8px 0 0;
		}
		.mt-50{
			margin-top:80px;
		}
		.invoice-panel{
			padding:40px; 
		}
		.footer{
			background: linear-gradient(to right, #0196d9 0%, #0075bf 100%);
			min-height:50px; 
			border-radius: 0 0 8px 8px!important;
		}
		#paypal-button{
			background:transparent;
			margin: auto;
		}
	</style>
</head>

<body>

	<div class="container">
		<div class="row justify-content-center mt-50" id="divMessage">
			<div class="col-md-5 bg-white" id="divToHide">
				<div class="row topHeader">
					<div class="col-md-12 text-center successicon">
						<h2>Payment Details</h2>
						 
					</div>
		
				</div>

			<div class="row">
				<div class="col-md-12">	
					<div class="invoice-panel">
						<div class="row">
							<div class="col-md-6">
								<p class="label">Invoice No:</p>
							</div>
							<div class="col-md-6 text-right">
								<p>{{ $invoice_no }}</p>
							</div>
							<div class="col-md-6">
								<p class="label">Order No:</p>
							</div>
							<div class="col-md-6 text-right">
								<p>{{ $order_no }}</p>
							</div>					
							<div class="col-md-6">
								<p class="label">Amount:</p>
							</div>
							<div class="col-md-6 text-right">						
								<p>${{ $amount }}</p>
							</div>
							<div class="col-md-6">
								<p class="label">Payment Due Date:</p>
							</div>
							<div class="col-md-6 text-right">	
								<p>{{ date('m-d-Y', strtotime($due)) }}</p>
							</div>
						</div>
					</div>
					<div style="text-align: center;">
						<button type="button" id="paypal-button" style="border:none;"></button>
					</div>
				</div>
				<div class="col-sm-12 text-center pt-2 footer">
					<div class="row">
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

<script src="https://www.paypalobjects.com/api/checkout.js"></script>

<!--
JavaScript code to render PayPal checkout button and execute payment
-->
<script>

paypal.Button.render({
    // Configure environment
    env: "{{env('PAYPAL_SANDBOX')?'sandbox':'production'}}",
    client: {
        sandbox: "{{env('PAYPAL_API_CLIENT_ID')}}",
        production: "{{env('PAYPAL_API_CLIENT_ID')}}"
    },
    // Customize button (optional)
    locale: 'en_US',
    style: {
    	label: 'pay',
        size: 'medium',
        color: 'gold',
        shape: 'pill',
    },
    commit: true,
    // Set up a payment
    payment: function (data, actions) {
        return actions.payment.create({
            transactions: [{
                amount: {
                    total: '{{ $amount }}',
                    currency: 'USD'
                }
            }],
            application_context: {
				shipping_preference: "NO_SHIPPING",
			}
		});
    },
    
    // Execute the payment
    onAuthorize: function (data, actions) {
        return actions.payment.execute().then(function () {
            // Show a confirmation message to the buyer
            //window.alert('Thank you for your purchase!');
            // Redirect to the payment process page
            
            document.getElementById("divToHide").style.display = "none";
            document.getElementById("divMessage").innerHTML  = "<p><img src=\"{{url('public/images/giphy.gif')}}\"></p>";
			window.location = "{{URL::to('/')}}/process/"+data.paymentID+"/"+data.paymentToken+"/"+data.payerID+"/{{$invoice_no}}";
        });
    },
    onCancel: function(data, actions) {
      	window.location = "{{URL::to('/')}}/failed/";
    },

    onError: function(err) {
      	window.location = "{{URL::to('/')}}/failed/"+err;
    }
}, '#paypal-button');
</script>
	
<link href="{{ URL::asset('resources/js/jquery.min.js') }}" rel="script">
<link href="{{ URL::asset('resources/js/bootstrap.min.js') }}" rel="script">

</body>
</html>