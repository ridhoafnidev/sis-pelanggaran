<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Siswa</th>
            <th>Jurusan</th>
            <th>Kelas</th>
            <th>Pelanggaran</th>
            <th>Poin</th>
            <th>Tahun Ajaran</th>
        </tr>
    </thead>
    <tbody>
    @php 
    $no = 1;
    @endphp
    @foreach($pelanggaran_siswa as $pelanggaran)

    @php
        $set = App\Settings::all();
        $ta = App\TahunAjaran::where('tahun_awal', $set[0]->tahun_aktif )->get();
        $pelanggarans = DB::table('konseling')
        ->selectRaw('sum(jenis_pelanggaran.poin) as total')
        ->join('pelanggaran_detail', 'pelanggaran_detail.id', '=', 'konseling.pelanggaran_detail_id')
        ->join('pelanggaran', 'pelanggaran.id', '=', 'pelanggaran_detail.pelanggaran_id')
        ->join('jenis_pelanggaran', 'jenis_pelanggaran.id', '=', 'pelanggaran_detail.jenis_pelanggaran_id')
        ->where('pelanggaran_detail.nis','=', $pelanggaran->nis)
        ->where('pelanggaran_detail.tahun_ajaran_id','=',$ta[0]->id)
        ->groupBy('pelanggaran_detail.nis')
        ->get(); 
    @endphp

        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $pelanggaran->nama_siswa }}</td>
            <td>{{ $pelanggaran->jurusan }}</td>
            <td>{{ $pelanggaran->rombel }}</td>
            <td>{{ $pelanggaran->jenis_pelanggaran }}</td>
            <td>{{ $pelanggarans[0]->total }}</td>
            <td>{{ $pelanggaran->tahun_ajaran }}</td>
        </tr>
    @endforeach
    </tbody>
</table>