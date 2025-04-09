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
            $table->string('kategoripasien', 25)->comment('nifas/hamil, lansia');
            $table->string('nik', 225)->unique();
            $table->string('namapasien', 225);
            $table->date('tgl_lahir', 225)->nullable();
            $table->string('alamat', 225)->nullable();
            $table->string('nohp', 225)->nullable();

            // *** data ibu hamil
            $table->integer('hamil_ke')->nullable()->default(0);
            $table->integer('minggu_ke')->nullable()->default(0);
            $table->integer('bb')->nullable()->default(0);
            $table->integer('lila')->nullable()->comment('lingkar lengan atas')->default(0);
            $table->string('tekanan_darah', 50)->nullable();
            $table->string('nama_suami', 225)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tbl_bayi', function (Blueprint $table) {
            $table->uuid('kodebayi')->primary();
            $table->uuid('kodepasien');
            $table->string('namabayi', 225);
            $table->integer('anakke')->default(1);
            $table->integer('tinggibadan')->default(1);
            $table->integer('beratbadan')->default(1);
            $table->integer('carabersalin')->default(1)->comment("1 = Persalinan Normal, 2 = Persalinan Caesar, 3 = Persalinan dengan Bantuan Alat, 4 = Persalinan di Air, 5 = Persalinan Lotus");
            $table->date('tgl_lahir');
            $table->date('tgl_bersalin')->nullable();
            $table->string('tempatbersalin', 225)->nullable();
            $table->char('jk', 1)->default('L');
            $table->timestamps();
            $table->softDeletes();
        });

        // *** pemeriksaan
        Schema::create('tbl_pemeriksaan', function (Blueprint $table) {
            $table->uuid('kodepemeriksaan')->primary();
            $table->uuid('kodepasien');
            $table->uuid('kodebayi')->nullable();
            $table->string('kategori_periksa', 25)->comment('nifas, hamil, lansia');
            $table->date('tgl_periksa');

            // *** BUMIL
            $table->integer('is_kelas_bumil')->nullable()->default(0);
            $table->integer('is_rujuk')->nullable()->default(0)->comment('Rujuk Pustu/Puskesmas/Rumah Sakit');
            $table->text('edukasi')->nullable()->comment('Edukasi yang Diberikan');

            // ** Hasil Penimbangan/Pengukuran/Pemeriksaan
            $table->integer('bb')->nullable()->default(0);
            $table->integer('is_sesuai_kurva_bb')->nullable()->default(0);
            $table->integer('lila')->nullable()->default(0);
            $table->string('tekanan_darah', 50)->nullable();
            $table->integer('is_sesuai_kurva_tekanan_darah')->nullable()->default(0);

            // ** Skrining TBC
            $table->integer('is_batuk')->nullable()->default(0);
            $table->integer('is_demam')->nullable()->default(0);
            $table->integer('is_bb_tidak_naik_turun')->nullable()->default(0);
            $table->integer('is_kontak_pasien_tbc')->nullable()->default(0);

            // ** Pemberian TTD & MT Bumil KEK
            $table->integer('is_beri_tablet')->nullable()->default(0);
            $table->integer('jml_tablet')->nullable()->default(0);
            $table->integer('konsumsi_tablet')->nullable()->default(0)->comment("1 = setiap hari, 0 = tidak setiap hari");
            $table->integer('is_beri_mt')->nullable()->default(0);
            $table->text('mt_bumil')->nullable();
            $table->integer('konsumsi_mt_bumil')->nullable()->comment("1 = setiap hari, 0 = tidak setiap hari");

            // *** NIFAS

            // ** Pemberian Vit A, Menyusui dan KB
            $table->integer('is_beri_vit_a')->nullable()->default(0);
            $table->integer('jml_tablet_vit_a')->nullable()->default(0);
            $table->integer('is_konsumsi_vit_a')->nullable()->default(0);
            $table->integer('is_menyusui')->nullable()->default(0);
            $table->integer('is_kb')->nullable()->default(0);

            $table->timestamps();
            $table->softDeletes();
        });

        // *** pemeriksaan
        // Schema::create('tbl_pemeriksaan_nifas', function (Blueprint $table) {
        //     $table->uuid('kodepemeriksaan')->primary();
        //     $table->uuid('kodepasien');
        //     $table->uuid('kodebayi');

        //     // *** Hasil Penimbangan/Pengukuran/Pemeriksaan
        //     $table->integer('bb')->nullable()->default(0);
        //     $table->integer('lila')->nullable()->default(0);
        //     $table->string('tekanan_darah', 50)->nullable();
        //     $table->integer('is_sesuai_kurva')->nullable()->default(0);

        //     $table->timestamps();
        //     $table->softDeletes();
        // });


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
