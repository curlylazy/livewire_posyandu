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
            $table->string('kategoripasien', 25)->comment('nifas/hamil')->nullable();
            $table->string('nik', 225)->unique()->nullable();
            $table->string('namapasien', 225);
            $table->date('tgl_lahir', 225)->nullable();
            $table->string('alamat', 225)->nullable();
            $table->string('nohp', 225)->nullable();
            $table->char('jk', 1)->default('L');
            $table->decimal('tinggibadan')->default(1);
            $table->decimal('beratbadan')->nullable()->default(0);

            // *** jika perempuan
            $table->uuid('kodesuami')->nullable();

            // *** data untuk balita
            $table->uuid('kodeayah')->nullable();
            $table->uuid('kodeibu')->nullable();
            $table->integer('anakke')->default(1);
            $table->decimal('tinggibadan_lahir')->default(0);
            $table->decimal('beratbadan_lahir')->default(0);
            $table->decimal('lingkar_kepala')->default(0);
            $table->integer('carabersalin')->default(1)->comment("1 = Persalinan Normal, 2 = Persalinan Caesar, 3 = Persalinan dengan Bantuan Alat, 4 = Persalinan di Air, 5 = Persalinan Lotus");
            $table->date('tgl_bersalin')->nullable();
            $table->string('tempatbersalin', 225)->nullable();

            // *** data ibu hamil
            $table->integer('hamil_ke')->nullable()->default(0);
            $table->integer('minggu_ke')->nullable()->default(0);
            $table->decimal('lila')->nullable()->comment('lingkar lengan atas')->default(0);
            $table->string('tekanan_darah', 50)->nullable();
            $table->integer('status')->default(1)->comment("0 = tidak aktif, 1 = aktif");
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tbl_bayi', function (Blueprint $table) {
            $table->uuid('kodebayi')->primary();
            $table->uuid('kodepasien');
            $table->string('namabayi', 225);
            $table->integer('anakke')->default(1);
            $table->decimal('tinggibadan')->default(1);
            $table->decimal('beratbadan')->default(1);
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
            $table->string('kategori_periksa', 25)->comment('nifas, hamil, lansia, bayibalita');
            $table->date('tgl_periksa');

            // *** saat diperiksa berapa usianya, biasa digunakan untuk pemeriksaan bayi/balita
            $table->integer('periksa_umur_bulan')->nullable();
            $table->integer('periksa_umur_tahun')->nullable();

            // *** BUMIL
            $table->integer('periksa_hamil_ke')->nullable()->default(0);
            $table->integer('periksa_minggu_ke')->nullable()->default(0);

            // ** Hasil Penimbangan/Pengukuran/Pemeriksaan
            $table->integer('periksa_bb')->nullable()->default(0);
            $table->integer('is_sesuai_kurva_bb')->nullable()->default(0);
            $table->integer('periksa_lila')->nullable()->default(0);
            $table->string('periksa_tekanan_darah', 50)->nullable();
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

            // *** Kelas Ibu Hamil
            $table->integer('is_kelas_bumil')->nullable()->default(0);
            $table->integer('is_rujuk')->nullable()->default(0)->comment('Rujuk Pustu/Puskesmas/Rumah Sakit');
            $table->text('edukasi')->nullable()->comment('Edukasi yang Diberikan');

            // *** NIFAS

            // ** Pemberian Vit A, Menyusui dan KB
            $table->integer('periksa_bb_bayi')->nullable()->default(0);
            $table->integer('periksa_tinggi_badan')->nullable()->default(0);
            $table->integer('periksa_lingkar_kepala')->nullable()->default(0);
            $table->integer('is_beri_vit_a')->nullable()->default(0);
            $table->integer('jml_tablet_vit_a')->nullable()->default(0);
            $table->integer('is_konsumsi_vit_a')->nullable()->default(0);
            $table->integer('is_menyusui')->nullable()->default(0);
            $table->integer('is_kb')->nullable()->default(0);

            // *** comment berarti menggunakan table yang sudah ada, hanya membantu pembuatan menu saja
            // ** Pemeriksaan Balita
            // $table->integer('periksa_umur_bulan')->nullable();
            // $table->integer('periksa_umur_tahun')->nullable();
            // $table->integer('periksa_bb')->nullable()->default(0);
            // $table->integer('periksa_tinggi_badan')->nullable()->default(0);
            // $table->integer('periksa_lingkar_kepala')->nullable()->default(0);
            $table->integer('is_asi_ekslusif')->default(1)->comment('0 = tidak, 1 = ya');
            $table->integer('is_mpasi_sesuai')->default(1)->comment('0 = tidak, 1 = ya');
            $table->integer('is_imunisasi_lengkap')->default(1)->comment('0 = tidak, 1 = ya');
            // $table->integer('is_beri_vit_a')->nullable()->default(0);
            $table->integer('is_beri_obat_cacing')->default(1)->comment('0 = tidak, 1 = ya');
            $table->integer('is_mt_pangan_lokal_pemulihan')->default(1)->comment('0 = tidak, 1 = ya');
            $table->integer('is_gejala_sakit')->default(1)->comment('0 = tidak, 1 = ya');
            $table->integer('gejala_sakit_keterangan')->nullable()->comment('jika ada gejala sakit, sebutkan alasannya');
            // $table->text('edukasi')->nullable()->comment('Edukasi yang Diberikan');
            // $table->integer('is_rujuk')->nullable()->default(0)->comment('Rujuk Pustu/Puskesmas/Rumah Sakit');

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
