<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableAdmins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::table('admins', function (Blueprint $table) {
        $table->string('category')->nullable();
        $table->string('coupon')->nullable();
		$table->string('product')->nullable();
		$table->string('blog')->nullable();
		$table->string('order')->nullable();
		$table->string('other')->nullable();
		$table->string('report')->nullable();
		$table->string('role')->nullable();
		$table->string('return')->nullable();
		$table->string('contact')->nullable();
		$table->string('comment')->nullable();
		$table->string('setting')->nullable();
		$table->integer('type')->nullable();
    });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
            Schema::table('admins', function (Blueprint $table) {
        $table->string('category')->nullable();
        $table->string('coupon')->nullable();
		$table->string('product')->nullable();
		$table->string('blog')->nullable();
		$table->string('order')->nullable();
		$table->string('other')->nullable();
		$table->string('report')->nullable();
		$table->string('role')->nullable();
		$table->string('return')->nullable();
		$table->string('contact')->nullable();
		$table->string('comment')->nullable();
		$table->string('setting')->nullable();
		$table->integer('type')->nullable();
    });

    }
}
