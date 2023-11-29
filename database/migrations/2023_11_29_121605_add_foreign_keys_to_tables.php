<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign('categories_parent_id_foreign');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->id()->change();
            $table->unsignedBigInteger('parent_id')->nullable()->change();
            $table->foreign('parent_id')->references('id')
                ->on('categories')->onDelete('set null')->onUpdate('cascade');
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->id()->change();
            $table->unsignedBigInteger('author_id')->nullable()->change();
            $table->foreign('author_id')->references('id')
                ->on('users')->onDelete('set null')->onUpdate('cascade');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->id()->change();
            $table->unsignedBigInteger('category_id')->nullable()->change();
            $table->unsignedBigInteger('author_id')->nullable()->change();
            $table->foreign('author_id')->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('category_id')->references('id')
                ->on('categories')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['posts_category_id_foreign', 'posts_author_id_foreign']);
            $table->integer('author_id')->change();
            $table->integer('category_id')->nullable()->change();
            $table->increments('id')->change();
        });
        Schema::table('pages', function (Blueprint $table) {
            $table->dropForeign('pages_author_id_foreign');
            $table->integer('author_id')->change();
            $table->increments('id')->change();
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign('parent_id');
            $table->integer('parent_id')->unsigned()->nullable()->default(null)->change();
            $table->increments('id')->change();
            $table->foreign('parent_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('set null');
        });
    }
};
