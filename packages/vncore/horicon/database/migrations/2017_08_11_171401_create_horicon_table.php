<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoriconTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('title')->nullable()->after('email');
            $table->text('bio')->nullable()->after('email');
            $table->string('timezone')->nullable()->after('email');
            $table->text('fcm_token')->nullable()->after('email');
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('user_role', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('role_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });

        Schema::create('faqs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('content')->nullable();
            $table->boolean('status')->default(false);

            $table->text('replay')->nullable();
            $table->dateTime('replayed_at');

            $table->unsignedInteger('user_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });

        Schema::create('faq_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content');

            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('faq_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('faq_id')->references('id')->on('faqs')->onDelete('cascade');
        });

        Schema::create('blog_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title'); // ~ 60 characters
            $table->string('slug')->unique();
            $table->text('content')->nullable();
            $table->boolean('status')->default(true);

            $table->text('meta_description')->nullable(); // ~ 150 characters
            $table->text('layout')->nullable();

            $table->timestamps();
        });

        // Brand Name | Major Product Category - Minor Product Category - Name of Product
        // Moz: Seo software, tool and resources for better marketing
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title'); // ~ 60 characters
            $table->string('slug')->unique();
            $table->text('content')->nullable();
            $table->text('summary')->nullable();
            $table->boolean('status')->default(true);

            $table->text('meta_description')->nullable(); // ~ 150 characters
            $table->text('layout')->nullable();

            $table->unsignedInteger('category_id')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('blog_categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_posts');

        Schema::dropIfExists('blog_categories');

        Schema::dropIfExists('faq_comments');
        Schema::dropIfExists('faqs');

        Schema::dropIfExists('user_role');
        Schema::dropIfExists('roles');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['title', 'bio', 'timezone']);
        });
    }
}
