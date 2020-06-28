<div class="card-body">
    <div class="form-group">
        <label for="title">NIP</label>
        {!! Form::number('nip', null, ['class' => $errors->has('nip') ? 'form-control is-invalid' : 'form-control', 'required' => 'required', 'autofocus' => 'autofocus']) !!}
        @if ($errors->has('nip'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('nip') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="title">Nama Lengkap</label>
        {!! Form::text('nama_lengkap', null, ['class' => $errors->has('nama_lengkap') ? 'form-control is-invalid' : 'form-control', 'required' => 'required', 'autofocus' => 'autofocus']) !!}
        @if ($errors->has('nama_lengkap'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('nama_lengkap') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="title">No HP</label>
        {!! Form::number('no_hp', null, ['class' => $errors->has('no_hp') ? 'form-control is-invalid' : 'form-control', 'required' => 'required', 'autofocus' => 'autofocus']) !!}
        @if ($errors->has('no_hp'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('no_hp') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="title">Email</label>
        {!! Form::text('email', null, ['class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control', 'required' => 'required', 'autofocus' => 'autofocus']) !!}
        @if ($errors->has('email'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="title">Jenis Kelamin</label>
        {!! Form::select('jenis_kelamin', ['Laki-Laki' => 'Laki-Laki', 'Perempuan' => 'Perempuan'], null, ['class' => $errors->has('jenis_kelamin') ? 'form-control is-invalid' : 'form-control', 'required' => 'required', 'autofocus' => 'autofocus']) !!}
        @if ($errors->has('jenis_kelamin'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('jenis_kelamin') }}</strong>
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
</div>
<div class="card-footer bg-transparent">
    <button class="btn btn-primary" type="submit">
        Submit
    </button>
</div>