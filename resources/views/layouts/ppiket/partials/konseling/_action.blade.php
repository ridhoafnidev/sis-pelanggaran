{!! Form::model($model, ['url' => $delete_url, 'method' => 'DELETE']) !!}
 <a href="{{ $edit_url }}" class="btn btn-sm btn-outline-secondary" style="padding-bottom: 0px; padding-top: 0px;">
        Rincian
        <span class="btn-label btn-label-right"><i class="fa fa-edit"></i></span>
    </a>
{!! Form::close() !!}