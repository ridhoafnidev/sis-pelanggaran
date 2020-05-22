<div class="card-body">
    <div class="form-group">
        <label for="name">Full Name</label>
        {!! Form::text('name', null, ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus']) !!}
        @if ($errors->has('name'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="email">Username</label>
        {!! Form::text('email', null, ['class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control', 'required']) !!}
        @if ($errors->has('email'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        {!! Form::password('password', ['class' => $errors->has('password') ? 'form-control is-invalid' : 'form-control']) !!}
        @if ($errors->has('password'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="role">Role</label>

        {!! Form::select('admin', ['' => '-']+ App\Level::pluck('level', 'id')->all() , null, ['class' => $errors->has('category_id') ? 'form-control is-invalid' : 'form-control', 'required']) !!}
        @if ($errors->has('category_id'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('category_id') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="avatar">Avatar</label>
        <div class="input-group">
            <span class="input-group-btn">
                <a id="lfm" data-input="avatar" data-preview="holder" class="btn btn-primary text-white">
                    <i class="fa fa-cloud-upload"></i> Choose
                </a>
            </span>
            {!! Form::text('avatar', null, ['id' => 'avatar', 'class' => $errors->has('avatar') ? 'form-control is-invalid' : 'form-control', 'readonly']) !!}
            @if ($errors->has('avatar'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('avatar') }}</strong>
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
        $(document).ready( function () {
            $('#lfm').filemanager('image');
        });
    </script>
@endsection
