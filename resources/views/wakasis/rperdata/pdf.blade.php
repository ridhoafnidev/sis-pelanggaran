<!DOCTYPE html>
<html>
<head>
<title>cetak</title>

<div class="col">
    <table border="0">
      <tr>
      <td>
      <!-- <img src="{{asset('images/a.png')}}"> -->
      <!-- <img src="('images/a.png')" height="50" width="50"> -->
      </td>
        <td>
        <h3 style=" text-align: center;font-size: 16px;"><b>
    PEMERINTAHAN KABUPATEN ROKAN HILIR<br>
    BADAN PENDAPATAN DAERAH<br>
    <b style="text-align: center;">Alamat : Jl. Jend Sudirman Km. 16 Tangun Kode Pos 28557
    </b><br>
    <b style="text-align: center;">BAGAN SIAPI-API</b>
    </p>
    </h3>
        </td>
        <td>
          <h4 style=" text-align: center">
            SURAT KETERANGAN PAJAK DAN RETRIBUSI DAERAH<br>
            (SKPD/SKRD)<br><br><br><br>
          </h4>
        </td>
      </tr>
    </table>
     </div>
    <hr>     
  <p>
</head>
<body>

<table align="center">
  <tr>
    <td>Nama</td>
    <td>:</td>
    <td>{{$reklame->name}}</td>
  </tr>
  <tr>
    <td>Alamat</td>
    <td>:</td>
    <td>{{$reklame->alamat}}</td>
  </tr>
  <tr>
    <td>NPWP</td>
    <td>:</td>
    <td>{{$reklame->npwp}}</td>
  </tr>
</table>
<p>Penyetoran   : 30 (Tiga Puluh) hari setelah penyetoran</p>
<table style="width: 100%", border="1">

      <tr>
        <th>Kode Rekening</th>
        <th>Pajak dan Rekribusi Daerah</th>
        <th>Ukuran</th>
        <th>Jumlah Ketetapan</th>
      </tr>
      <tr>
        <td>7010-01-018531-53-0</td>
        <td>{{ $reklame->des_jenis }}</td>
        <td>{{ $reklame->panjang }} Meter x {{ $reklame->lebar }}Meter</td>
        <td>
        <?php 
         $a = $reklame->lebar;
         $b = $reklame->panjang;
         $c = $reklame->qty;
         $d = $reklame->nsr;

         $luas = $a * $b;
         $pajak = 25/100;
 
         $hasil = $luas *$c*$d *$pajak;

        ?>
        {{
          $hasil
        }}</td>
      </tr>
      <tr>
        <td colspan="3">Jumlah Pajak / Kontribusi terutang sebesar</td>
        <td>{{$hasil}}</td>
      </tr>
    </table>
    <P><i>Perhatian :</i></P>
    <pre>
    1. Harap peyetoran dilakukan kepada bendahara khusus Penerimaan Badan Pendapatan Daerah Kabupaten 
       Rokan Hilir
    2. Surat ketetapan ini dinyatakan LUNAS jika telah disyahkan/Validasi kas Register atau Cap dari 
       Bapenda Rohil
    3. Tanda pejabat BKP/PBKB Bapenada Rokan Hilir
    4. Terlambat membayar dari tanggal batas penyetoran terakhir dikenakan DENDA sebesar 2 % (dua) persen 
       setiap bulannya, sesuai dengan PERATURAN DAERAH YANG BERLAKU
       </pre>
    <table border="1">
        <tr>
          <td colspan="2">
          PENYETOR
          </td>
        </tr>
        <tr>
          <td>
          
            kepada Yth,<br>
            Kepla Badan Pendapatan Daerah Kabupaten Rokan Hilir
            agar menerima penyetoran untuk keuntungan rekening
            atas Daerah kabupaten Rokan Hilir
            
          </td>
          <td>Tempat Pembayaran</td>
        </tr>
    </table>
    
</body>
</html>