<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Rekap Detail Pelanggaran Siswa</title>
    <style>
        table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        }
        th, td {
        padding: 5px;
        }
        th {
        text-align: left;
        }
    </style>
</head>

<body>
    <?php
        $set = App\Settings::all();
        $ta = App\TahunAjaran::where('tahun_awal', $set[0]->tahun_aktif )->get();
        $pelanggarans = DB::table('konseling')
        ->selectRaw('sum(jenis_pelanggaran.poin) as total')
        ->join('pelanggaran_detail', 'pelanggaran_detail.id', '=', 'konseling.pelanggaran_detail_id')
        ->join('pelanggaran', 'pelanggaran.id', '=', 'pelanggaran_detail.pelanggaran_id')
        ->join('jenis_pelanggaran', 'jenis_pelanggaran.id', '=', 'pelanggaran_detail.jenis_pelanggaran_id')
        ->where('pelanggaran_detail.nis','=', $pelanggaran[0]->nis)
        ->where('pelanggaran_detail.tahun_ajaran_id','=',$ta[0]->id)
        ->groupBy('pelanggaran_detail.nis')
        ->get();
    ?>
    <h3 style="text-align: center;">Rincian Data Pelanggaran Siswa</h3>
    @php $no = 1; $count=sizeof($pelanggaranSemua); @endphp

<table border="1" style="width: 100%;">
    <tbody>
        <tr>
        <td>Nama </td>
        <th>{{$dataPelanggaran[0]->nama_siswa}} </th>
        </tr>
        <tr>
        <td>Kelas: </td>
        <th> {{$dataPelanggaran[0]->rombel}}i </th>
        </tr>
        <tr>
        <td>Akumulasi Poin: </td>
        <th> {{$pelanggarans[0]->total}} </th>
        </tr>
        <tr>
        <td>Detail </td>
        <th >  </th>
        </tr>
    </tbody>
</table>

@php $no=1 @endphp
@for ($i=0; $i<$count;$i++)
<h3>Pelanggaran {{$no++}}</h3>
<table border="1" style="width: 100%;">
    <tbody>
        <tr>
        <td>Nama Guru</td>
        <th>{{$pelanggaranSemua[$i]->nama_guru}} </th>
        </tr>
        <tr>
        <td>Pelanggaran: </td>
        <th>{{$pelanggaranSemua[$i]->jenis_pelanggaran}} </th>
        </tr>
        <tr>
        <td>Poin: </td>
        <th> {{$pelanggaranSemua[$i]->poin}} </th>
        </tr>
        <tr>
        <td>Petugas </td>
        <th >{{$pelanggaranSemua[$i]->nama_petugas}} </th>
        </tr>
        <tr>
        <td>Deskripsi Penanganan </td>
        <th >{{$pelanggaranSemua[$i]->deskripsi_penanganan}} </th>
        </tr>

        <tr>
        <td>Hasil Konseling </td>
        <th >{{$pelanggaranSemua[$i]->hasil_konseling}} </th>
        </tr>

        <tr>
        <td>Rekomendasi </td>
        <th >{{$pelanggaranSemua[$i]->rekomendasi}} </th>
        </tr>

        <tr>
        <td>Konseler </td>
        <th >{{$pelanggaranSemua[$i]->konseler}} </th>
        </tr>

        <tr>
        <td>Keterangan </td>
        <th >{{$pelanggaranSemua[$i]->keterangan}} </th>
        </tr>

    </tbody>
</table>
@endfor
</body>

</html>