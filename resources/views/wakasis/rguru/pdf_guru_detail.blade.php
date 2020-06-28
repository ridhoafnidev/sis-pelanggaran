<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Rekap Detail Guru</title>
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
    <h3 style="text-align: center;">Rincian Data Kehadiran Guru</h3>
    @php $no = 1; $count=sizeof($kehadiran); @endphp

<table border="1" style="width: 100%;">
    <tbody>
        <tr>
        <td>Hadir </td>
        <th> {{$count_hadir}} Kali </th>
        </tr>
        <tr>
        <td>Tidak Hadir Tanpa Keterangan: </td>
        <th> {{$count_thtk}} Kali </th>
        </tr>
        <tr>
        <td>Tidak Hadir Dengan Keterangan: </td>
        <th> {{$count_thdk}} Kali </th>
        </tr>
        <tr>
        <td>Telat Hadir </td>
        <th> {{$count_th}} Kali </th>
        </tr>
        <tr>
        <td>Cepat Keluar Kelas: </td>
        <th> {{$count_ckk}} Kali </th>
        </tr>
    </tbody>
</table>

<br>

    <table border="1" style="width: 100%;">
        <thead>
            <tr>
                <th>No.</th> 
                <th>Nama Guru</th> 
                <th>Kehadiran</th>
                <th>Nama Petugas</th>
            </tr>
        </thead>
        <tbody> @php $no=1 @endphp
                @for ($i=0; $i<$count;$i++)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$kehadiran[$i]->guru}}</td>
                <td>{{$kehadiran[$i]->kehadiran}}</td>
                <td>{{$kehadiran[$i]->petugas}}</td>
            </tr>
                @endfor

    </table>
</body>

</html>