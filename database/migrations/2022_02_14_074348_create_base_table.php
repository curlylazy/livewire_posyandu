<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_user', function (Blueprint $table) {
            $table->uuid('kodeuser')->primary();
            $table->string('username', 25);
            $table->string('password', 255);
            $table->string('namauser', 50);
            $table->string('akses', 25)->comment('admin, staff');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tbl_activity', function (Blueprint $table) {
            $table->uuid('kodeactivity')->primary();
            $table->string('namaactivity', 225);
            $table->text('keterangansingkat')->nullable();
            $table->longText('keterangan')->nullable();
            $table->string('gambaractivity', 150);
            $table->integer('nourut')->default(0);
            $table->string('seoactivity', 225);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tbl_package', function (Blueprint $table) {
            $table->uuid('kodepackage')->primary();
            $table->string('namapackage', 225);
            $table->longText('keterangan');
            $table->json('activityinclude')->nullable();
            $table->integer('harga');
            $table->string('gambarpackage', 150)->nullable();
            $table->string('seopackage', 225);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tbl_galeri_activity', function (Blueprint $table) {
            $table->uuid('kodegaleriactivity')->primary();
            $table->uuid('kodeactivity');
            $table->string('gambargaleriactivity', 150);
            $table->timestamps();
        });

        Schema::create('tbl_galeri', function (Blueprint $table) {
            $table->uuid('kodegaleri')->primary();
            $table->string('namagaleri', 225);
            $table->string('gambargaleri', 225);
            $table->timestamps();
        });

        Schema::create('tbl_testimony', function (Blueprint $table) {
            $table->uuid('kodetestimony')->primary();
            $table->string('nama', 225);
            $table->string('avatar', 225)->nullable();
            $table->text('keterangantestimony');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tbl_blog', function (Blueprint $table) {
            $table->uuid('kodeblog')->primary();
            $table->uuid('kodeuser');
            $table->string('namablog', 225);
            $table->text('keterangansingkat');
            $table->longText('keterangan');
            $table->string('gambarblog', 150);
            $table->string('seoblog', 225);
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_user');
    }
};
