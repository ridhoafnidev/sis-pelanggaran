<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Rekap Siswa</title>
</head>

<body>
    <h3 style="text-align: center;">Rekap Data Pelanggaran Siswa</h3>
    <table border="1" style="width: 100%;  text-align:center;">
        <table border="1" style="width: 100%;  text-align:center;">
            <thead>
                <tr>
                    <th>Nama Siswa</th>
                    <th>Jurusan</th>
                    <th>Kelas</th>
                    <th>Pelanggaran</th>
                    <th>Poin</th>
                    <th>Status</th>
                </tr>

            </thead>
            <tbody>
            @foreach($data_siswa as $siswa)
                <tr>
                    
                    <td>{{$siswa->nama_siswa}}</td>
                    <td>{{$siswa->jurusan}}</td>
                    <td>{{$siswa->rombel}}</td>
                    <td>{{$siswa->jenis_pelanggaran}}</td>
                    <td>{{$siswa->poin}}</td>
                    <td>{{$siswa->status}}</td>
                </tr>
                @endforeach
            </tbody>



        </table>

</body>

</html>