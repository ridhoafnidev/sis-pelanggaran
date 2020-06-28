<div class="card-body">
    @php $no = 1; $count=sizeof($kehadiran); @endphp

    <table class="table table-bordered">
        <tbody>
            <tr>
            <td>Hadir </td>
            <th scope="row"> {{$count_hadir}} Kali </th>
            </tr>
            <tr>
            <td>Tidak Hadir Tanpa Keterangan: </td>
            <th scope="row"> {{$count_thtk}} Kali </th>
            </tr>
            <tr>
            <td>Tidak Hadir Dengan Keterangan: </td>
            <th scope="row"> {{$count_thdk}} Kali </th>
            </tr>
            <tr>
            <td>Telat Hadir </td>
            <th scope="row"> {{$count_th}} Kali </th>
            </tr>
            <tr>
            <td>Cepat Keluar Kelas: </td>
            <th scope="row"> {{$count_ckk}} Kali </th>
            </tr>
        </tbody>
    </table>
    <div class="form-group">
        <label for="title">Nama Guru</label>
        <input class="form-control" required="required" type="text" readonly="true" value="{{$kehadiran[0]->guru}}" />
    </div>
    @for ($i=0; $i<$count;$i++)
    <div class="form-group">
        <h3>Kehadiran {{$no++}}</h3>
    </div>
    <div class="row">
        <div class="col">
        <label for="title">Kehadiran</label>
        <input class="form-control" required="required" name="kehadiran" type="text" readonly="true"
            value="{{$kehadiran[$i]->kehadiran}}" />
        </div>
        <div class="col">
        <label for="title">Petugas Piket</label>
        <input class="form-control" required="required" name="nama_petugas" type="text" readonly="true"
            value="{{$kehadiran[$i]->petugas}}" />
        </div>
    </div>
@endfor
<div class="card-footer bg-transparent">
    <a href="{{route('wakasis.wakasis.cetak.rguru.detail',$data[0]->id)}}" target="_blank" class="float-right btn btn-primary"><i class="fa fa-print"></i> Print</a>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>