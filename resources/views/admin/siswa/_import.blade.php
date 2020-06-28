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
        <label for="nis">NIS</label>
        
        {!! Form::number('nis', null, ['class' => $errors->has('nis') ? 'form-control is-invalid' : 'form-control', 'required']) !!}
        @if ($errors->has('nis'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('nis') }}</strong>
        </span>
        @endif
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
        <label for="no_hp">No. HP</label>
        {!! Form::text('no_hp', null, ['class' => $errors->has('no_hp') ? 'form-control is-invalid' : 'form-control', 'required']) !!}
        @if ($errors->has('no_hp'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('no_hp') }}</strong>
        </span>
        @endif
    </div>

    <?php
    $jenis_kelamin = array(
        '' => '-',
        'Laki-Laki' => 'Laki - Laki',
        'Perempuan' => 'Perempuan'
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
        <label for="rombel">Rombongan Belajar</label>
        {!! Form::text('rombel', null, ['class' => $errors->has('rombel') ? 'form-control is-invalid' : 'form-control', 'required']) !!}
        @if ($errors->has('rombel'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('rombel') }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group">
        <label for="jurusan">Jurusan</label>
        {!! Form::select('jurusan', ['' => '-']+ App\Jurusan::pluck('jurusan', 'id')->all() , null, ['class' => $errors->has('jurusan') ? 'form-control is-invalid' : 'form-control', 'required']) !!}
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