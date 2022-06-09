<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSosConversationAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sos_conversation_admins', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->text('content');
            $table->integer('support_id')->unsigned();
            $table->integer('admin_id')->unsigned();
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
        });

        Schema::table('sos_conversation_admins', function($table) {
            $table->foreign('support_id')->references('id')->on('sos_supports');
            $table->foreign('admin_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sos_conversation_admins');
    }
}
