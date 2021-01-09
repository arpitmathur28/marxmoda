
<style>
td{
	padding:15px 5px;
}
</style>
<table style="width:80%;border:0px;margin:auto;box-shadow: 0 0 5px 0 gray;padding:40px;">
	<tr>
		<td style="width:40%;">
			<img src="{{$message->embed(asset('public/images/logo.png'))}}" width="20%">
		</td>
		<td style="width:50%;text-align: right;">
			<div>Date: <b>{{date("m-d-Y")}}</b></div>
		</td>
	</tr>
	<tr>
		<td colspan="2"><div>Hello <b>{{ $name }},</b></div>
Thank you for the payment of <b>${{$body["amt"]}}</b>, you have made to <b>{{$body["toName"]}}</b>. We are always welcome your valueable feedback. Kindly continue shop with us in future.
		</td>
	</tr>	
	<tr>
		<td>Invoice No.:-</td>
		<td style="width:60%;"><b>{{$body["invoice"]}}</b></td>
	</tr>
	<tr>
		<td>Transaction Id.:-</td>
		<td style="width:60%;"><b>{{$body["txn"]}}</b></td>
	</tr>
	<tr><td></td></tr>
	<tr>
		<td colspan="2" ><div>Your Sincerely:-<br><b>MarxModa<br>Eastern Michigan's Certified Herman Miller Dealer</b></div></td> 
	</tr> 
</table>