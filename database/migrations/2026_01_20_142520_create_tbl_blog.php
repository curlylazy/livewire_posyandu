<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_blog', function (Blueprint $table) {
            $table->uuid('kodeblog')->primary();
            $table->uuid('kodeuser');
            $table->string('judul', 200);
            $table->text('isi')->nullable();
            $table->date('tgl_blog');
            $table->string('gambarblog', 225);
            $table->string('seoblog', 225);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_blog');
    }
};
