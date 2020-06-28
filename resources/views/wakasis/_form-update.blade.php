<div class="card-body">
    <div class="form-group">
        <label for="nama_lengkap">Nama Lengkap</label>
        {!! Form::text('nama_lengkap', null, ['class' => $errors->has('nama_lengkap') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus']) !!}
        @if ($errors->has('nama_lengkap'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('nama_lengkap') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group">
        <label for="nis">NISN</label>
        <input class="form-control" required="required" type="text" readonly="true" value="{{str_pad($siswa->nis, 10, '0', STR_PAD_LEFT)}}"/>
    </div>
    <div class="form-group">
        <label for="alamat">Alamat</label>
        {!! Form::textArea('alamat', null, ['class' => $errors->has('alamat') ? 'form-control is-invalid' : 'form-control', 'required' => 'required', 'autofocus' => 'autofocus']) !!}
        @if ($errors->has('alamat'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('alamat') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group">
        <label for="no_hp">Tempat Lahir</label>
        {!! Form::text('tempat_lahir', null, ['class' => $errors->has('tempat_lahir') ? 'form-control is-invalid' : 'form-control', 'required']) !!}
        @if ($errors->has('tempat_lahir'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('tempat_lahir') }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group">
        <label for="no_hp">Tanggal Lahir</label>
        {!! Form::date('tanggal_lahir', null, ['class' => $errors->has('tanggal_lahir') ? 'form-control is-invalid' : 'form-control', 'required']) !!}
        @if ($errors->has('tanggal_lahir'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('tanggal_lahir') }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group">
        <label for="no_hp">Orang Tua/Wali</label>
        {!! Form::text('ortu_wali', null, ['class' => $errors->has('ortu_wali') ? 'form-control is-invalid' : 'form-control', 'required']) !!}
        @if ($errors->has('ortu_wali'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('ortu_wali') }}</strong>
        </span>
        @endif
    </div>

    <?php
    $jenis_kelamin = array(
        '' => '-Pilih Jenis Kelamin-',
        'L' => 'Laki - Laki',
        'P' => 'Perempuan'
    );
    ?>
    <div class="form-group">
        <label for="jenis_kelamin">Jenis Kelamin</label>

        {!! Form::select('jenis_kelamin',$jenis_kelamin, null,['class' => $errors->has('jenis_kelamin') ? 'form-control is-invalid' : 'form-control', 'required']) !!}
        @if ($errors->has('jenis_kelamin'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('jenis_kelamin') }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group">
        <label for="jurusan">Kelas</label>
        {!! Form::select('rombel', ['' => '-Pilih Kelas-']+ App\Kelas::pluck('kelas', 'kelas')->all() , null, ['class' => $errors->has('rombel') ? 'form-control is-invalid' : 'form-control', 'required']) !!}
        @if ($errors->has('rombel'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('rombel') }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group">
        <label for="jurusan">Jurusan</label>
        {!! Form::select('jurusan', ['' => '-Pilih Jurusan-']+ App\Jurusan::pluck('jurusan', 'id')->all() , null, ['class' => $errors->has('jurusan') ? 'form-control is-invalid' : 'form-control', 'required']) !!}
        @if ($errors->has('jurusan'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('jurusan') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group">
        <label for="foto">Avatar</label>
        <div class="input-group">
            <span class="input-group-btn">
                <a id="lfm" data-input="avatar" data-preview="holder" class="btn btn-primary text-white">
                    <i class="fa fa-cloud-upload"></i> Choose
                </a>
            </span>
            {!! Form::text('foto', null, ['id' => 'foto', 'class' => $errors->has('foto') ? 'form-control is-invalid' : 'form-control', 'readonly']) !!}
            @if ($errors->has('foto'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('foto') }}</strong>
            </span>
            @endif
        </div>
        <!-- if -->
        <!-- <img src="#" id="holder" style="margin-top:15px;max-height:254px;max-width: 152px;"> -->
        <!-- endif -->
        <img id="holder" style="margin-top:15px;max-height:254px;max-width: 152px;">
    </div>
</div>
<div class="card-footer bg-transparent">
    <button class="btn btn-primary" type="submit">
        Submit
    </button>
</div>

@section('assets-bottom')
<script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#lfm').filemanager('image');
    });
</script>
@endsection