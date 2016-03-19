<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function($table)
        {
            $table->increments('id');
            $table->integer('number')->nullable();
            $table->string('name')->nullable();
            $table->string('menus')->nullable();
            $table->string('remark')->nullable();
            $table->tinyInteger('type')->nullable(); // 0:中午 1:晚上
            $table->date('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
