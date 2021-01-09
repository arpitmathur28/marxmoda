<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Payments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {

            $table->increments('id')->primary();
            $table->integer('invoice_no',11)->unique();
            $table->string('txnid',50);
            $table->decimal('payment_amount',11,2);
            $table->string('payment_status',25);
            $table->string('payer_id',25);
            $table->string('payer_name',50)->nullable()->default('NULL');
            $table->string('payer_email',50)->nullable()->default('NULL');
            $table->timestamp('created_at')->nullable()->default('current_timestamp');
            $table->timestamp('updated_at')->nullable()->default('current_timestamp');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
