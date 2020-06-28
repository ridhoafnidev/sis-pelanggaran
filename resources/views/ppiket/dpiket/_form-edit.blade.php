<div class="card-body">
        <div class="table-responsive"> 
            <span id="result"></span>
                <table class="table table-bordered table-striped" id="user_table">
                    <thead>
                        <tr>
                            <th width="20%">Kelas</th>
                            <th width="25%">Siswa</th>
                            <th width="20%">Detail</th>
                            <th width="30%">Pelanggaran</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
        </div>

        <div class="form-group">
            <label for="title">Guru</label>
            <select name="guru_id" class="form-control input-lg">
            <option value="">== Pilih Guru ==</option>
            @foreach ($guru as $data)
            <option value="{{ $data->id }}" <?php if($data->id == $pelanggaran[0]->guru_id){ echo "selected"; }?> >{{  $data->nama_lengkap }}</option>
            @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="title">Kehadiran</label>
            <select name="kehadiran_id" class="form-control input-lg">
            <option value="">== Pilih Kehadiran ==</option>
            @foreach ($kehadiran as $data)
            <option value="{{ $data->kode_kehadiran }}" <?php if($data->kode_kehadiran == $pelanggaran[0]->kode_kehadiran){ echo "selected"; }?> >{{  $data->jenis_kehadiran }}</option>
            @endforeach
            </select>
        </div>

        <div class="form-group"> 
            <label for="title">Petugas Piket</label>
            <input class="form-control" required="required" name="nama_petugas" type="text" value="{{$pelanggaran[0]->nama_petugas}}"/>
            <input class="form-control" required="required" name="id_pelanggaran" type="hidden" value="{{$pelanggaran[0]->pelanggaran_id}}"/>
        </div>

    </div>

    <div class="card-footer bg-transparent"> 
        <a href="{{ route('ppiket.dpiket.index') }}" class="btn btn-danger">
            Batal
        </a>

        <button class="float-right btn btn-primary" type="submit" name="save">
            Ajukan
        </button>
    </div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
$(document).ready(function(){

 var count = 1;

 dynamic_field(count);

 function dynamic_field(number)
 {
  html = '<tr>';
        html += '<td><select name="kelas" id="kelas_'+number+'" class="kelas-dropdown form-control input-lg dynamic", disabled="true", data-dependent="siswa_'+number+'"><option value="">== Pilih Kelas ==</option>@foreach ($kelas as $datakelas)<option value="{{ $datakelas->kelas }}"  <?php if($datakelas->kelas == $pelanggaran[0]->rombel){ echo "selected"; }?> >{{  $datakelas->kelas }}</option>@endforeach</select></td>';
        html += '<td><select name="siswa" id="siswa_'+number+'" class="siswa-dropdown form-control input-lg dynamic" disabled="true" data-dependent="datasiswa_'+number+'"><option value="{{ $pelanggaran[0]->rombel }}">== Pilih Siswa ==</option></select></td>';
        html += '<td> <div name="datasiswa" id="datasiswa_'+number+'"></div></td>';
        html += '<td><select name="pelanggaran" class="form-control input-lg"><option value="">== Pilih Pelanggaran ==</option>@foreach ($jpelanggaran as $pelanggaran)<option value="{{ $pelanggaran->id }}" <?php if($pelanggaran->id == $dataPelanggaran[0]->jenis_pelanggaran_id){ echo "selected"; }?>>{{  $pelanggaran->jenis_pelanggaran }}</option>@endforeach</select></td>';
        if(number > 1)
        {
            //html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Hapus</button></td></tr>';
            $('tbody').append(html);
        }
        else
        {   
            //html += '<td><button type="button" name="add" id="add" class="btn btn-success">Tambah</button></td></tr>';
            $('tbody').html(html);
        }
 }

 $(document).on('click', '#add', function(){
  count++;
  dynamic_field(count);
 });

 $(document).on('click', '.remove', function(){
  count--;
  $(this).closest("tr").remove();
 });

 $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
}); 

}); 
</script>

<script>
function tampilkanSiswaDetail(){
    // mas ada id siswa nya  ? pakai nis mas, itu maksdudnya ya mas?
    $('.siswa-dropdown').each(function(index, el){
        console.log('kelas changed again');
        if($(this).val() != '')
        {
            var select = $(this).attr("id");
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('ppiket.dpiket.devsiswa') }}",
                method: "POST",
                data: {select:select, value:value, _token:_token, dependent:dependent},
                success:function(result)
                {
                    $('#'+dependent).html(result);
                }
            })
        }
    });
}

function tampilkanSiswa(){
    // mas ada id siswa nya  ? pakai nis mas, itu maksdudnya ya mas?
    $('.kelas-dropdown').each(function(index, el){
        console.log('kelas changed again');
        if($(this).val() != '')
        {
            var select = $(this).attr("id");
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('ppiket.dpiket.devkelas') }}",
                method: "POST",
                data: {select:select, value:value, _token:_token, dependent:dependent},
                success:function(result)
                {
                    $('#'+dependent).html(result);
                    $('#'+dependent).val({{ $dataPelanggaran[0]->nis }});
                    tampilkanSiswaDetail();

                }
            })
        }
    });
}

$(document).ready(function(){
    //$('.kelas-dropdown').change(function(){
    tampilkanSiswa();
    $('body').on('change', '.kelas-dropdown', function(){
        console.log('kelas changed');
        if($(this).val() != '')
        {
            var select = $(this).attr("id");
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('ppiket.dpiket.devkelas') }}",
                method: "POST",
                data: {select:select, value:value, _token:_token, dependent:dependent},
                success:function(result)
                {
                    $('#'+dependent).html(result);
                }
            })
        }
    })
})

$(document).ready(function(){
    tampilkanSiswaDetail();
    $('body').on('change', '.siswa-dropdown', function(){
        console.log('kelas changed');
        if($(this).val() != '')
        {
            var select = $(this).attr("id");
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('ppiket.dpiket.devsiswa') }}",
                method: "POST",
                data: {select:select, value:value, _token:_token, dependent:dependent},
                success:function(result)
                {
                    $('#'+dependent).html(result);
                }
            })
        }
    })
})
</script>


