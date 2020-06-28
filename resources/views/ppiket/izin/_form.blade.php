<div class="card-body">
<div class="table-responsive">
    <span id="result"></span>
        <table class="table table-bordered table-striped" id="user_table">
            <thead>
                <tr>
                    <th width="20%">Kelas</th>
                    <th width="25%">Siswa</th>
                    <th width="25%">Detail</th>
                    <th width="25%">Keterangan Izin</th>
                    <th width="15%"></th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
   </div>

        <div class="form-group">
            <label for="title">Guru</label>
            {!! Form::select('guru_id', [' '=>' --Pilih Guru--']+App\Guru::pluck('nama_lengkap', 'id')->all(), null, ['name' => 'guru_id', 'id' => 'guru_id', 'class' => $errors->has('guru_id') ? 'form-control is-invalid' : 'form-control input-lg', 'required']) !!}
            @if ($errors->has('guru_id'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('guru_id') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="title">Keterangan</label>
            {!! Form::select('kehadiran_id', [' '=>' --Pilih Kehadiran--']+App\Kehadiran::pluck('jenis_kehadiran', 'kode_kehadiran')->all(), null, ['name' => 'kehadiran_id', 'id' => 'kehadiran_id', 'class' => $errors->has('kehadiran_id') ? 'form-control is-invalid' : 'form-control input-lg', 'required']) !!}
            @if ($errors->has('kehadiran_id'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('kehadiran_id') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group"> 
            <label for="title">Petugas Piket</label>
            {!! Form::text('nama_petugas', null, ['class' => $errors->has('nama_petugas') ? 'form-control is-invalid' : 'form-control']) !!}
            @if ($errors->has('nama_petugas'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('nama_petugas') }}</strong>
                </span>
            @endif
        </div>

    </div>

    <div class="card-footer bg-transparent">
        <button class="btn btn-primary" type="submit" name="save" id="save">
            Simpan
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
        html += '<td><select name="kelas[]" id="kelas_'+number+'" class="kelas-dropdown form-control input-lg dynamic", data-dependent="siswa_'+number+'"><option value="">== Pilih Kelas ==</option>@foreach ($kelas as $datakelas)<option value="{{ $datakelas->kelas }}">{{  $datakelas->kelas }}</option>@endforeach</select></td>';
        html += '<td><select name="siswa[]" id="siswa_'+number+'" class="siswa-dropdown form-control input-lg dynamic" data-dependent="datasiswa_'+number+'"><option value="">== Pilih Siswa ==</option></select></td>';
        html += '<td> <div name="datasiswa" id="datasiswa_'+number+'"></div></td>';
            
        html += '<td>{!! Form::textarea('keterangan_izin[]', null, ['class' => $errors->has('keterangan_izin') ? 'form-control is-invalid' : 'form-control', 'rows'=>'2', 'cols'=>'50']) !!}</td>';
        if(number > 1)
        {
            html += '<td><button type="button" name="remove" id="" class="btn btn-sm btn-danger remove">Hapus</button></td></tr>';
            $('tbody').append(html);
        }
        else
        {   
            html += '<td><button type="button" name="add" id="add" class="btn btn-sm btn-success">Tambah</button></td></tr>';
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

 $('#dynamic_form').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url:'{{ route("ppiket.izin.store") }}',
            method:'post',
            data:$(this).serialize(),
            dataType:'json',
            beforeSend:function(){
                $('#save').attr('disabled','disabled');
            },
            success:function(data)
            {
                if(data.error)
                {
                    var error_html = '';
                    for(var count = 0; count < data.error.length; count++)
                    {
                        error_html += '<p>'+data.error[count]+'</p>';
                    }
                    $('#result').html('<div class="alert alert-danger">'+error_html+'</div>');
                }
                else
                {
                    dynamic_field(1);
                    document.getElementById("dynamic_form").reset();
                    $('#result').html('<div class="alert alert-success">'+data.success+'</div>');
                }
                $('#save').attr('disabled', false);
            }
        })
 });

});
</script>

<script>
$(document).ready(function(){
    //$('.kelas-dropdown').change(function(){
      
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


