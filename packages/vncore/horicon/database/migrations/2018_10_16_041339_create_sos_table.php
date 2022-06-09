<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSosTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('sos_companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('name');
            $table->text('desc')->nullable();
            $table->timestamps();
        });

        Schema::create('sos_contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();

            $table->unsignedInteger('company_id')->nullable();
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('sos_companies')->onDelete('set null');
        });

        Schema::create('sos_contract_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('lat', 10, 8);
            $table->decimal('lng', 11, 8);

            $table->unsignedInteger('contract_id')->nullable();
            $table->timestamps();

            $table->foreign('contract_id')->references('id')->on('sos_contracts')->onDelete('cascade');
        });

        Schema::create('sos_supports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('location')->nullable();
            $table->decimal('lat', 10, 8);
            $table->decimal('lng', 11, 8);
            $table->text('content')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('urgent')->default(true);
            $table->boolean('status')->default(true);

            $table->text('replay')->nullable();
            $table->dateTime('replayed_at');

            $table->unsignedInteger('user_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });

        Schema::create('sos_conversations', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content')->nullable();

            $table->unsignedInteger('support_id')->nullable();
            $table->unsignedInteger('admin_id')->nullable();
            $table->timestamps();

            $table->foreign('support_id')->references('id')->on('sos_supports')->onDelete('set null');
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('set null');
        });

        Schema::create('sos_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question');
            $table->timestamps();
        });

        Schema::create('sos_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('social_id')->nullable();
            $table->date('birthday')->nullable();
            $table->date('departure_date')->nullable();
            $table->boolean('gender')->default(true);
            $table->string('phone')->nullable();
            $table->string('security_answer')->nullable();
            $table->boolean('match_location')->default(true);

            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('contract_id')->nullable();
            $table->unsignedInteger('question_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('contract_id')->references('id')->on('sos_contracts')->onDelete('set null');
            $table->foreign('question_id')->references('id')->on('sos_questions')->onDelete('set null');
        });

        Schema::create('sos_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('text')->nullable();
            $table->string('document')->nullable();
            $table->string('link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('sos_conversations');
        Schema::dropIfExists('sos_supports');

        Schema::dropIfExists('sos_users');
        Schema::dropIfExists('sos_questions');

        Schema::dropIfExists('sos_contract_locations');
        Schema::dropIfExists('sos_contracts');
        Schema::dropIfExists('sos_companies');

        Schema::dropIfExists('sos_notifications');
    }
}
