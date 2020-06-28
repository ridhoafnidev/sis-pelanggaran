{!! Form::model($model, ['url' => $delete_url, 'method' => 'DELETE']) !!}
    <a href="{{ $show_url }}" class="btn btn-sm btn-outline-info" style="padding-bottom: 0px; padding-top: 0px;">
        Show
        <span class="btn-label btn-label-right"><i class="fa fa-eye"></i></span>
    </a>
    <a href="{{ $edit_url }}" class="btn btn-sm btn-outline-secondary" style="padding-bottom: 0px; padding-top: 0px;">
        Edit
        <span class="btn-label btn-label-right"><i class="fa fa-edit"></i></span>
    </a>
{!! Form::close() !!}