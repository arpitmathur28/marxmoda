<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use App\CustomClass\PaypalExpress;
use Hashids\Hashids;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
	protected function sendMail($inputs){
		$to_name = $inputs["payerName"];
		$to_email = $inputs["payerEmail"];

//Email template
		$data = array('name'=>$to_name, "body" => ["invoice"=>$inputs["invoice"], "txn"=>$inputs["txn"], "amt"=>$inputs["amt"], "toName"=>env('MAIL_FROM_NAME'), "fromName"=>$inputs["payerName"]]);

		Mail::send('mail', $data, function($message) use ($to_name, $to_email) {
			$message->to($to_email, $to_name)->subject('Payment Successful - MarxModa');
			$message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
			
		});
	}

	protected function isPaid($invoiceNumber){
		if(!empty($invoiceNumber)){ 
			$paymentDetails = Payment::where('invoice_no', '=', $invoiceNumber);
			if($paymentDetails->count() > 0){				
				return false;
			}
			return true;
		}
		return false;
	}

    public function checkout($invoice = null){
		$hashids = new Hashids();
		
		$decrypted = $hashids->decode($invoice);
		if(isset($decrypted[0])){

//check for invoice already existing or not
			//if($this->isPaid($decrypted[0])){
				$order = Order::where('invoice_no', '=', $decrypted[0]);
				
				if($order->count() == 1){
					$result = $order->get();
					return view('checkout')->with(['invoice_no'=>$result[0]->invoice_no, 'order_no'=>$result[0]->order_no, 'amount'=>$result[0]->amount, 'due'=>$result[0]->due_date]);
					
				}else{
					echo "<h1>Invalid Link</h1>";
				}
			// }else{
			// 	echo "<h1>Invalid Link</h1>";
			// }
		}else{
			echo "<h1>Invalid Link</h1>";
		}
	}
	
	public function process($paymentID = null, $token = null, $payerID = null, $pid = null){
		
		if(!empty($paymentID) && !empty($token) && !empty($payerID) && !empty($pid) ){ 
			
// Include and initialize paypal class 
			$paypal = new PaypalExpress(); 
			 
// Get payment info from URL 
			$paymentID = $paymentID; 
			$token = $token; 
			$payerID = $payerID; 
			$productID = $pid; 
			 
// Validate transaction via PayPal API 
			$paymentCheck = $paypal->validate($paymentID, $token, $payerID, $productID); 
			 
// If the payment is valid and approved 
			if($paymentCheck && $paymentCheck->state == 'approved'){ 
		 
				// Get the transaction data 
				$tid = $paymentCheck->id; 
				$state = $paymentCheck->state; 
				$payerFirstName = $paymentCheck->payer->payer_info->first_name; 
				$payerLastName = $paymentCheck->payer->payer_info->last_name; 
				$payerName = $payerFirstName.' '.$payerLastName; 
				$payerEmail = $paymentCheck->payer->payer_info->email; 
				$payerID = $paymentCheck->payer->payer_info->payer_id; 
				$payerCountryCode = $paymentCheck->payer->payer_info->country_code; 
				$paidAmount = $paymentCheck->transactions[0]->amount->details->subtotal; 
				$currency = $paymentCheck->transactions[0]->amount->currency; 
				 
// Get product details 
				$order = Order::where('invoice_no', '=', $productID);
				if($order->count() == 1){
					$result = $order->get();
					$productData = $result[0]; 
				 
// If payment price is valid 
					if($productData['amount'] >= $paidAmount){ 
						 
// Insert transaction data in the database 
						 
						$insert = Payment::insertGetId([
							'invoice_no' => $productID, 
							'txnid' => $tid, 
							'payment_amount' => $paidAmount,
							'payment_status' => $state ,
							'payer_id' => $payerID, 
							'payer_name' => $payerName, 
							'payer_email' => $payerEmail,
							'created_at' => date("Y-m-d h:i:s"),
							'updated_at' => date("Y-m-d h:i:s")
						]);
						$this->sendMail(["payerName"=>$payerName, "payerEmail"=>$payerEmail, "invoice"=>$productID, "txn"=>$tid, "amt"=>$paidAmount]);

						$hashids = new Hashids();
		
						$encryptedId = $hashids->encode($insert);
// Add insert id to the URL 
						return redirect('/success/'.$encryptedId); 
					} 
				}
			} 
			
		}else{ 
			// Redirect to the home page 
			return redirect('/failed/'); 
		}
		return redirect('/failed/');
	}
	
	public function status($id = null){
		if(!empty($id)){ 
			$hashids = new Hashids();
		
			$decryptedId = $hashids->decode($id);
			if(isset($decryptedId[0])){
// Include and initialize database class 
				$payment = Payment::where('id', '=', $decryptedId); 
				if($payment->count() == 1){
					$result = $payment->get();
					$paymentData = $result[0]; 
					
					return view('success')->with(['paymentResult'=>$paymentData]);
				}else{ 
					echo "Invalid id found";
				}
			}
		}else{ 
			echo "Invalid id found";
		} 
	}
}
