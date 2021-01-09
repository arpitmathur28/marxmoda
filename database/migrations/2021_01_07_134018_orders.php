<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->increments('id')->primary();
            $table->integer('invoice_no',11)->unique();
            $table->integer('order_no',11)->nullable()->default('NULL');
            $table->string('customer_po_no',50)->nullable()->default('NULL');
            $table->string('bill_to_account',10)->nullable()->default('NULL');
            $table->decimal('amount',11,2);
            $table->string('sales',50)->nullable()->default('NULL');
            $table->timestamp('invoice_date')->nullable()->default('NULL');
            $table->timestamp('due_date')->nullable()->default('NULL');
            $table->string('customer_email',50)->nullable()->default('NULL');
            $table->text('bill_address')->nullable()->default('NULL');
            $table->text('shipping_address')->nullable()->default('NULL');
            $table->string('API_response',256)->nullable()->default('NULL');
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
