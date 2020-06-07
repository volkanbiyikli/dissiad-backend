<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('license')->nullable();
            $table->longText('address')->nullable();
            $table->string('city')->nullable();
            $table->string('authorized')->nullable();
            $table->string('authorized_email')->nullable();
            $table->string('telephone')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('url')->nullable();
            $table->enum('product', ['0', '1'])->default(0);
            $table->enum('export', ['0', '1'])->default(0);
            $table->enum('import', ['0', '1'])->default(0);
            $table->longText('profile')->nullable();
            $table->longText('map')->nullable();
            $table->string('image')->nullable();
            $table->enum('status', ['0', '1'])->default(1);
            $table->string('slug');
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
        Schema::dropIfExists('members');
    }
}
