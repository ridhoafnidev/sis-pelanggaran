{!! Form::model($model, ['url' => $masuk_edit_url, 'method' => 'PUT']) !!}


<button type="submit" class="btn btn-md btn-outline-info" style="padding-bottom: 0px; padding-top: 0px;" onclick="return confirm('Update Data?');">
    Tidak
    <span class="btn-label btn-label-right"><i class="fa fa-edit"></i></span>
</button>
{!! Form::close() !!}