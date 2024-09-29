<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgreementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agreements', function (Blueprint $table) {
            $table->id();
            $table->enum('agreement_type', ['sale', 'rental']);
            $table->string('agreement_date', 40);
            $table->string('start_date', 20)->nullable();
            $table->string('end_date', 20)->nullable();
            $table->string('rent_term', 30)->nullable();
            $table->string('adviser', 40)->nullable();
            $table->string('customer_name',30);
            $table->string('customer_birth',20)->nullable();
            $table->string('customer_tel',20)->nullable();
            $table->string('owner_name',30);
            $table->string('owner_birth',20)->nullable();
            $table->string('owner_tel',20)->nullable();
            $table->text('description')->nullable();
            $table->string('mortgage_price', 30)->nullable();
            $table->string('rent_price', 30)->nullable();
            $table->string('sell_price', 30)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agreements');
    }
}
