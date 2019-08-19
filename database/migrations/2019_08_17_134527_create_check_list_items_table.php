<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckListItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_list_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name")->default("task");
            $table->boolean("done")->default("0");

            $table->unsignedBigInteger("check_list_id");
            $table->foreign("check_list_id")->references("id")->on("check_lists")
            ->onDelete("cascade");
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
        Schema::dropIfExists('check_list_items');
    }
}
