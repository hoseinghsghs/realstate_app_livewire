<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id()->from(1000);
            //new
            $table->string('code')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('lable')->nullable();
            $table->string('tr_type')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->longText('district')->nullable();
            $table->boolean('isactive')->nullable();
            $table->boolean('ischenge')->nullable();
            //new
            $table->string('type')->nullable();
            $table->string('usertype')->nullable();
            $table->string('lon')->nullable();
            $table->string('lat')->nullable();
            $table->integer('bedroom')->nullable();
            $table->string('address')->nullable();
            $table->string('loan')->nullable();
            $table->string('loanamount')->nullable();
            $table->string('meter_price')->nullable();
            $table->string('meter')->nullable();
            $table->integer('people_number')->nullable();
            $table->integer('year')->nullable();
            $table->string('door')->nullable();
            $table->string('area')->nullable();
            $table->string('rent')->nullable();
            $table->string('rahn')->nullable();
            $table->string('bidprice')->nullable();
            $table->string('ugprice')->nullable();
            $table->string('floorsell')->nullable();
            $table->string('floor')->nullable();
            $table->string('name_family')->nullable();
            $table->string('telephone')->nullable();
            $table->string('phone')->nullable();
            $table->string('doc')->nullable();
            $table->string('dimension')->nullable();
            $table->string('view')->nullable();
            $table->string('phone_line')->nullable();
            $table->string('screen')->nullable();
            $table->string('cover')->nullable();
            $table->string('cool')->nullable();
            $table->string('heat')->nullable();
            $table->string('cabinet')->nullable();
            $table->string('ambed')->nullable();
            $table->string('collection')->nullable();
            $table->string('img')->nullable();
            $table->string('otherimg')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('featured')->default(false);
            $table->foreignId('user_id')->constrained('users');
            $table->tinyInteger('rating')->default(5);
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
        Schema::dropIfExists('properties');
    }
}
