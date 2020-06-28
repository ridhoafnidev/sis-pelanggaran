{!! Form::model($model, ['url' => $keluar_edit_url, 'method' => 'PUT']) !!}
   
   
    <button  
        type="submit" disabled class="btn btn-md btn-outline-danger" 
        style="padding-bottom: 0px; padding-top: 0px;"
        onclick="return confirm('Update Data?');"
    >
    Ya
        
        <span class="btn-label btn-label-right"><i class="fa fa-pen"></i></span>
    </button>
{!! Form::close() !!}