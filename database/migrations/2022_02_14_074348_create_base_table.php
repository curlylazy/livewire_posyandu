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

        Schema::create('tbl_pasien', function (Blueprint $table) {
            $table->uuid('kodepasien')->primary();
            $table->string('kategori', 25)->comment('nifas, hamil, lansia');
            $table->string('nik', 225)->unique();
            $table->string('nama', 225);
            $table->date('tgl_lahir', 225)->nullable();
            $table->string('alamat', 225)->nullable();
            $table->string('nohp', 225)->nullable();

            // *** data ibu hamil
            $table->integer('hamil_ke')->nullable()->default(0);
            $table->integer('minggu_ke')->nullable()->default(0);
            $table->string('nama_suami', 225)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // *** pemeriksaan
        Schema::create('tbl_pemeriksaan', function (Blueprint $table) {
            $table->uuid('kodepemeriksaan')->primary();
            $table->uuid('kodepasien');
            $table->string('kategoriperiksa', 25)->comment('nifas, hamil, lansia');

            // *** BUMIL
            $table->integer('is_kelas_bumil')->nullable()->default(0);
            $table->integer('is_rujuk')->nullable()->default(0);
            $table->text('edukasi')->nullable();

            // *** Hasil Penimbangan/Pengukuran/Pemeriksaan
            $table->integer('bb')->nullable()->default(0);
            $table->integer('lila')->nullable()->default(0);
            $table->integer('tekanan_darah')->nullable()->default(0);
            $table->integer('is_sesuai_kurva')->nullable()->default(0);

            // *** Skrining TBC
            $table->integer('is_batuk')->nullable()->default(0);
            $table->integer('is_demam')->nullable()->default(0);
            $table->integer('is_bb_tidak_naik_turun')->nullable()->default(0);
            $table->integer('is_kontak_pasien_tbc')->nullable()->default(0);

            // *** Pemberian TTD & MT Bumil KEK
            $table->integer('is_beri_tablet')->nullable()->default(0);
            $table->integer('jml_tablet')->nullable()->default(0);
            $table->integer('is_beri_mt')->nullable()->default(0);
            $table->text('mt_bumil')->nullable()->default(0);
            $table->integer('konsumsi_mt_bumil')->nullable()->comment("1 = setiap hari, 0 = tidak setiap hari");

            // *** NIFAS


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
