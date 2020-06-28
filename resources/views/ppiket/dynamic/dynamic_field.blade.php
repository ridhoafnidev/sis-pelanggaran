<?php
use App\Kelas;

$kelas = Kelas::all();
?>
<html>
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Laravel 5.8 - DataTables Server Side Processing using Ajax</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 </head>
 <body>
  <div class="container">    
     <br />
     <h3 align="center">Dynamically Add / Remove input fields in Laravel 5.8 using Ajax jQuery</h3>
     <br />
   <div class="table-responsive">
                <form method="post" id="dynamic_form">
                 <span id="result"></span>
                 <table class="table table-bordered table-striped" id="user_table">
               <thead>
                <tr>
                    <th width="20%">First Name</th>
                    <th width="35%">Last Name</th>
                    <th width="35%">Last Name</th>
                    <th width="15%">Action</th>
                </tr>
               </thead>
               <tbody>

               </tbody>
               <tfoot>
                <tr>
                    <td colspan="3" align="right">&nbsp;</td>
                    <td>
                  <input type="submit" name="save" id="save" class="btn btn-primary" value="Save" />
                 </td>
                </tr>
               </tfoot>
           </table>
                </form>
   </div>
  </div>
 </body>
</html>

<script>
$(document).ready(function(){

 var count = 1;

 dynamic_field(count);

 function dynamic_field(number)
 {
  html = '<tr>';
        html += '<td><select name="last_name[]" id="kelas_'+number+'" class="kelas-dropdown form-control input-lg dynamic", data-dependent="siswa_'+number+'"><option value="">== Pilih Kelas ==</option>@foreach ($kelas as $datakelas)<option value="{{ $datakelas->kelas }}">{{  $datakelas->kelas }}</option>@endforeach</select></td>';
        html += '<td><select name="first_name[]" id="siswa_'+number+'" class="siswa-dropdown form-control input-lg dynamic" data-dependent="datasiswa_'+number+'"><option value="">== Pilih Siswa ==</option></select></td>';
        html += '<td> <div  name="datasiswa" id="datasiswa_'+number+'" class="row"></div></td>';
        if(number > 1)
        {
            html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Remove</button></td></tr>';
            $('tbody').append(html);
        }
        else
        {   
            html += '<td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td></tr>';
            $('tbody').html(html);
        }
 }

 $(document).on('click', '#add', function(){
  count++;
  dynamic_field(count);
  console.log('tambah row lagi');
 });

 $(document).on('click', '.remove', function(){
  count--;
  $(this).closest("tr").remove();
  console.log('ubah row lagi');
 });

 $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

 $('#dynamic_form').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url:'{{ route("ppiket.dynamic-field.insert") }}',
            method:'post',
            data:$(this).serialize(),
            dataType:'json',
            beforeSend:function(){
                $('#save').attr('disabled','disabled');
            },
            success:function(data)
            {
                if(data.error)
                {
                    var error_html = '';
                    for(var count = 0; count < data.error.length; count++)
                    {
                        error_html += '<p>'+data.error[count]+'</p>';
                    }
                    $('#result').html('<div class="alert alert-danger">'+error_html+'</div>');
                }
                else
                {
                    dynamic_field(1);
                    $('#result').html('<div class="alert alert-success">'+data.success+'</div>');
                }
                $('#save').attr('disabled', false);
            }
        })
 });

});
</script>

<script>
$(document).ready(function(){
    //$('.kelas-dropdown').change(function(){
      
    $('body').on('change', '.kelas-dropdown', function(){
        console.log('kelas changed');
        if($(this).val() != '')
        {
            var select = $(this).attr("id");
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('ppiket.dpiket.devkelas') }}",
                method: "POST",
                data: {select:select, value:value, _token:_token, dependent:dependent},
                success:function(result)
                {
                    $('#'+dependent).html(result);
                }
            })
        }
    })
})

$(document).ready(function(){
    $('body').on('change', '.siswa-dropdown', function(){
        console.log('kelas changed');
        if($(this).val() != '')
        {
            var select = $(this).attr("id");
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('ppiket.dpiket.devsiswa') }}",
                method: "POST",
                data: {select:select, value:value, _token:_token, dependent:dependent},
                success:function(result)
                {
                    $('#'+dependent).html(result);
                }
            })
        }
    })
})

</script>

