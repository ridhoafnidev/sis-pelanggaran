@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Settings</a>
            </li>
            <li class="breadcrumb-item active">Configuration</li>
          </ol>

          <div class="row">
              <div class="col-md-12">
                  <div class="card">
                    {!! Form::model($setting, ['route' => 'admin.settings.store', 'method' => 'POST']) !!}
                      <div class="card-header text-white bg-primary">
                          Setting
                      </div>
                      <div class="card-body">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-general" aria-selected="true">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-social" role="tab" aria-controls="pills-social" aria-selected="false">Social</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    {!! Form::text('title', null, ['class' => $errors->has('title') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus']) !!}
                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="tagline">Tagline</label>
                                    {!! Form::text('tagline', null, ['id' => 'tagline', 'class' => $errors->has('tagline') ? 'form-control is-invalid' : 'form-control', 'required']) !!}
                                    @if ($errors->has('tagline'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('tagline') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    {!! Form::text('phone', null, ['id' => 'phone', 'class' => $errors->has('phone') ? 'form-control is-invalid' : 'form-control', 'required']) !!}
                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    {!! Form::email('email', null, ['id' => 'email', 'class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control']) !!}
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    {!! Form::textarea('address', null, ['id' => 'textarea', 'class' => $errors->has('address') ? 'form-control is-invalid' : 'form-control']) !!}
                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-social" role="tabpanel" aria-labelledby="pills-social-tab">
                                <div class="form-group">
                                    <label for="so_facebook">Facebook</label>
                                    {!! Form::text('so_facebook', null, ['id' => 'so_facebook', 'class' => $errors->has('so_facebook') ? 'form-control is-invalid' : 'form-control', 'required']) !!}
                                    @if ($errors->has('so_facebook'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('so_facebook') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="so_twitter">Twitter</label>
                                    {!! Form::text('so_twitter', null, ['id' => 'so_twitter', 'class' => $errors->has('so_twitter') ? 'form-control is-invalid' : 'form-control', 'required']) !!}
                                    @if ($errors->has('so_twitter'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('so_twitter') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="so_instagram">Instagram</label>
                                    {!! Form::text('so_instagram', null, ['id' => 'so_instagram', 'class' => $errors->has('so_instagram') ? 'form-control is-invalid' : 'form-control', 'required']) !!}
                                    @if ($errors->has('so_instagram'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('so_instagram') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                      </div>
                    <div class="card-footer bg-transparent">
                        <button class="btn btn-primary" type="submit">
                            Publish
                        </button>
                    </div>
                    {!! Form::close() !!}
                  </div>
              </div>
          </div>
    </div>
@endsection