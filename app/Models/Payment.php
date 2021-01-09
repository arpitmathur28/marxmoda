<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
	public $timestamps = false;
	
	protected $table = 'payments';
	 protected $fillable = ['invoice_no', 'txnid', 'payment_amount', 'payment_status', 'payer_id', 'payer_name', 'payer_email', 'created_at', 'updated_at'];
}
