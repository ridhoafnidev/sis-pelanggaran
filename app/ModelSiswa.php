<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelSiswa extends Model
{
    protected $guarded = []; //TAMBAHKAN LINE INI
    public function up()
{
    Schema::create('siswa', function (Blueprint $table) {
        $table->increments('id');
        $table->string('nama_lengkap');
        $table->string('bis');
        $table->text('alamat')->nullable();
        $table->string('jenis_kelamin');
        $table->strng('jurusan');
        $table->string('rombel');
        $table->string('tempat_lahir');
        $table->string('rombel');
        $table->date('tanggal_lahir');
        $table->string('orang_tua');
        $table->string('foto');
        $table->string('nipd');
        $table->string('nik');
        $table->string('agama');
        $table->string('rt');
        $table->string('rw');
        $table->string('dusun');
        $table->string('keluarahan');
        $table->string('kecamatan');
        $table->string('kode_pos');
        $table->string('jenis_tinggal');
        $table->string('alat_transportasi');
        $table->string('telepon');
        $table->string('email');
        $table->string('skhun');
        $table->string('penerima_kps');
        $table->string('nama_ayah');
        $table->string('tahun_lahir_ayah');
        $table->string('jenjang_pendidikan_ayah');
        $table->string('pekerjaan_ayah');
        $table->string('penghasilan_ayah');
        $table->string('nik_ayah');
        $table->string('nama_ibu');
        $table->string('tahun_lahir_ibu');
        $table->string('jenjang_pendidikan_ibu');
        $table->string('pekerjaan_ibu');
        $table->string('penghasilan_ibu');
        $table->string('nik_ibu');
        $table->string('nama_wali');
        $table->string('tahun_lahir_wali');
        $table->string('jenjang_pendidikan_wali');
        $table->string('pekerjaan_wali');
        $table->string('penghasilan_wali');
        $table->string('nik_wali');
        $table->string('nomor_peserta_ujian');
        $table->string('no_seri_ijazah');
        $table->string('penerima_kip');
        $table->string('nomor_kks');
        $table->string('no_registrasi_akta_lahir');
        $table->string('bank');
        $table->string('nomor_rekening_bank');
        $table->string('rekening_atas_nama');
        $table->string('layak_pip');
        $table->string('alasan_layak_pip');
        $table->string('kebutuhan_khusus');
        $table->string('sekolah_asal');
        $table->integer('anak_keberapa');
        $table->double('lintang');
        $table->double('bujur');
        $table->string('no_kk');
        $table->integer('berat_badan');
        $table->integer('tinggi_badan');
        $table->integer('lingkar_kepala');
        $table->integer('jumlah_saudara_kandung');
        $table->double('jarak_rumah_ke_sekolah');
    });
}

public function down()
{
    Schema::dropIfExists('siswa');
}
}
