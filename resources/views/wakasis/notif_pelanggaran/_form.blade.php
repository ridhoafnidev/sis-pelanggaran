<div class="card-body">
    <div class="table-responsive">
        <span id="result"></span>
        <table class="table table-bordered table-striped" id="user_table">
            <thead>
                <tr>
                    <th width="25%">Kelas</th>
                    <th width="25%">Siswa</th>
                    <th width="25%">Detail</th>
                    <th width="25%">Akumulasi Poin</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    @php $no = 1; $count=sizeof($pelanggaranSemua); @endphp

    @for ($i=0; $i<$count;$i++) <div class="form-group">
        <h3>Pelanggaran {{ $no++ }}</h3>

<div class="row">
    <div class="col">
        <label>Pelanggaran</label>
        <select name="pelanggaran" class="form-control input-lg" disabled="true">
            <option value="">== Pilih Pelanggaran ==</option>
            @foreach ($jpelanggaran as $pelang)
            <option value="{{ $pelang->id }}"
                <?php if($pelang->id == $pelanggaranSemua[$i]->jenis_pelanggaran_id){ echo "selected"; }?>>
                {{  $pelang->jenis_pelanggaran }}</option>
            @endforeach
        </select>
    </div>
    <div class="col">
        <label for="title">Poin</label>
        <input class="form-control" readonly required="required" name="konseler" type="text"
            value="{{$pelanggaranSemua[$i]->poin}}" />
    </div>
</div>
<br>
<div class="row">
    <div class="col">
        <label for="title">Petugas Piket</label>
        <input class="form-control" required="required" name="nama_petugas" type="text" readonly="true"
            value="{{$pelanggaranSemua[$i]->nama_petugas}}" />
        <input class="form-control" required="required" name="id_konseling" type="hidden"
            value="{{$pelanggaran[0]->id_konseling}}" />
    </div>
    <div class="col">
        <label for="title">Deskripsi Penanganan</label>
        <textarea class="form-control" readonly name="deskripsi_penanganan" type="text"
            rows="2">{{$pelanggaranSemua[$i]->deskripsi_penanganan}}</textarea>
    </div>
</div>
<br>
<div class="row">
    <div class="col">
        <label for="title">Hasil Konseling</label>
        <textarea class="form-control" readonly name="hasil_konseling" type="text"
            rows="2">{{$pelanggaranSemua[$i]->hasil_konseling}}</textarea>
    </div>
    <div class="col">
        <label for="title">Rekomendasi</label>
        <textarea class="form-control" readonly name="rekomendasi" type="text"
            rows="2">{{$pelanggaranSemua[$i]->rekomendasi}}</textarea>
    </div>
</div>
<br>
<div class="row">
    <div class="col">
        <label for="title">Konseler</label>
        <input class="form-control" readonly required="required" name="konseler" type="text"
            value="{{$pelanggaranSemua[$i]->konseler}}" />
    </div>
    <div class="col">
        <label for="title">Keterangan</label>
        <select name="keterangan_konseling" disabled readonly class="form-control">
            <option value="">--Pilih Keterangan--</option>
            <option value="Selesai" <?php if($pelanggaranSemua[$i]->status == "Selesai"){ echo "selected"; }?>>Selesai
            </option>
            <option value="Belum Selesai" <?php if($pelanggaranSemua[$i]->status == "Belum Selesai"){ echo "selected"; }?>>
                Belum Selesai</option>
        </select>
    </div>
</div>
<br>
<div class="row">
    <div class="col">
        <label for="title">Guru</label>
        <select name="guru_id" class="form-control input-lg" disabled="true">
            <option value="">== Pilih Guru ==</option>
            @foreach ($guru as $data)
            <option value="{{ $data->id }}" <?php if($data->id == $pelanggaranSemua[$i]->guru_id){ echo "selected"; }?>>
                {{  $data->nama_lengkap }}</option>
            @endforeach
        </select>
    </div>
    <div class="col"></div>
</div>
</div> 
@endfor

<div class="card-footer bg-transparent">
    <a href="{{route('wakasis.wakasis.cetak.rsiswa.detail',$pelanggaran[0]->id)}}"  target="_blank" class="float-right btn btn-primary"><i class="fa fa-print"></i> Print</a>
</div>

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

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
$(document).ready(function() {

    var count = 1;

    dynamic_field(count);

    function dynamic_field(number) {
        html = '<tr>';
        html += '<td><select name="kelas" id="kelas_' + number +'" class="kelas-dropdown form-control input-lg dynamic", disabled="true", data-dependent="siswa_' +number +'"><option value="">== Pilih Kelas ==</option>@foreach ($kelas as $datakelas)<option value="{{ $datakelas->kelas }}"  <?php if($datakelas->kelas == $pelanggaran[0]->rombel){ echo "selected"; }?> >{{  $datakelas->kelas }}</option>@endforeach</select></td>';
        html += '<td><select name="siswa" id="siswa_' + number +'" class="siswa-dropdown form-control input-lg dynamic" disabled="true" data-dependent="datasiswa_' +number + '"><option value="{{ $pelanggaran[0]->rombel }}">== Pilih Siswa ==</option></select></td>';
        html += '<td> <div name="datasiswa" id="datasiswa_' + number + '"></div></td>';
        html +='<td> <input class="form-control" readonly required="required" name="konseler" type="text" value="{{$pelanggarans[0]->total}}"/> </td>';

        if (number > 1) {
            //html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Hapus</button></td></tr>';
            $('tbody').append(html);
        } else {
            //html += '<td><button type="button" name="add" id="add" class="btn btn-success">Tambah</button></td></tr>';
            $('tbody').html(html);
        }
    }

    $(document).on('click', '#add', function() {
        count++;
        dynamic_field(count);
    });

    $(document).on('click', '.remove', function() {
        count--;
        $(this).closest("tr").remove();
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#dynamic_form').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: '{{ route("ppiket.dpiket.update", $dataPelanggaran[0]->id) }}',
            method: 'post',
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function() {
                $('#save').attr('disabled', 'disabled');
            },
            success: function(data) {
                if (data.error) {
                    var error_html = '';
                    for (var count = 0; count < data.error.length; count++) {
                        error_html += '<p>' + data.error[count] + '</p>';
                    }
                    $('#result').html('<div class="alert alert-danger">' + error_html + '</div>');
                } else {
                    dynamic_field(1);
                    $('#result').html('<div class="alert alert-success">' + data.success +'</div>');
                }
                $('#save').attr('disabled', false);
            }
        })
    });

});
</script>

<script>
function tampilkanSiswaDetail() {
    // mas ada id siswa nya  ? pakai nis mas, itu maksdudnya ya mas?
    $('.siswa-dropdown').each(function(index, el) {
        console.log('kelas changed again');
        if ($(this).val() != '') {
            var select = $(this).attr("id");
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('wakasis.wakasis.devsiswa') }}",
                method: "POST",
                data: {
                    select: select,
                    value: value,
                    _token: _token,
                    dependent: dependent
                },
                success: function(result) {
                    $('#'+dependent).html(result);
                }
            })
        }
    });
}

function tampilkanSiswa() {
    // mas ada id siswa nya  ? pakai nis mas, itu maksdudnya ya mas?
    $('.kelas-dropdown').each(function(index, el) {
        console.log('kelas changed again');
        if ($(this).val() != '') {
            var select = $(this).attr("id");
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('wakasis.wakasis.devkelas') }}",
                method: "POST",
                data: {
                    select: select,
                    value: value,
                    _token: _token,
                    dependent: dependent
                },
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

$(document).ready(function() {
    //$('.kelas-dropdown').change(function(){
    tampilkanSiswa();
    $('body').on('change', '.kelas-dropdown', function() {
        console.log('kelas changed');
        if ($(this).val() != '') {
            var select = $(this).attr("id");
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('wakasis.wakasis.devkelas') }}",
                method: "POST",
                data: {
                    select: select,
                    value: value,
                    _token: _token,
                    dependent: dependent
                },
                success: function(result) {
                    $('#' + dependent).html(result);
                }
            })
        }
    })
})

$(document).ready(function() {
    tampilkanSiswaDetail();
    $('body').on('change', '.siswa-dropdown', function() {
        console.log('kelas changed');
        if ($(this).val() != '') {
            var select = $(this).attr("id");
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('wakasis.wakasis.devsiswa') }}",
                method: "POST",
                data: {
                    select: select,
                    value: value,
                    _token: _token,
                    dependent: dependent
                },
                success: function(result) {
                    $('#' + dependent).html(result);
                }
            })
        }
    })
})
</script>