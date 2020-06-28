@extends('layouts.admin.app')

@section('assets-top')
<!-- Page level plugin CSS-->
<link href="{{ asset('assets/blog-admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<!-- Responsive datatable examples -->
<link href="{{ asset('assets/blog-admin/vendor/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Data Izin Siswa</a>
        </li>
        <li class="breadcrumb-item active">Table</li>
    </ol>

    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-list"></i> Data Izin Siswa

        </div>
        <div class="card-body table-responsive">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>

                            <th>Nama</th>
                            <th>Keterangan</th>
                            <th>Keluar</th>
                            <th>Masuk</th>
                            <th>Foto</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>

                            <th>Nama</th>
                            <th>Keterangan</th>
                            <th>Keluar</th>
                            <th>Masuk</th>
                            <th>Foto</th>
                        </tr>
                    </tfoot>
                    <tbody>

                    </tbody>
                </table>
                <!--  <form action="{{route('pgerbang.pgerbang.store')}}" method="post">


                    {{csrf_field()}}
                    <input type="hidden" value="Y" name="keluar">
                    <input type="hidden" value="Y" name="masuk">
                    <input type="hidden" name="id" id="izin_id">
                    <input type="hidden" name="button_action" id="button_action" value="update">
                    <input type="submit" class="btn btn-primary" name="submit" id="action" value="Simpan">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>

                </form>-->
                <!-- <div class="modal" id="absenModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="{{route('pgerbang.pgerbang.store')}}" method="post" id="absen_form">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Keterangan Siswa</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {{csrf_field()}}
                                    <span id="form_output"></span>
                                    <div class="form-group">
                                        <label for="title">Masuk</label>
                                        <input type="text" name="masuk" class="form-control" id="masuk">
                                        <select class="form-control" name="masuk" id="masuk">
                                            <option value="Y">Ya</option>
                                            <option value="N">Tidak</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Keluar</label>
                                        <select class="form-control" name="keluar" id="keluar">
                                            <option value="Y">Ya</option>
                                            <option value="N">Tidak</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Tidak Masuk</label>
                                        <select class="form-control" name="tidak_masuk" id="tidak_masuk">
                                            <option value="Y">Ya</option>
                                            <option value="N">Tidak</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="id" id="izin_id">
                                    <input type="hidden" name="button_action" id="button_action" value="update">
                                    <input type="submit" class="btn btn-primary" name="submit" id="action" value="Simpan">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>-->
            </div>
        </div>
    </div>
</div>

@endsection

@section('assets-bottom')
<!-- Page level plugin JavaScript-->
<script src="{{ asset('assets/blog-admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/blog-admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Responsive examples -->
<script src="{{ asset('assets/blog-admin/vendor/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/blog-admin/vendor/datatables/responsive.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $("#dataTable").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('api.datatable.izin_gerbang') }}",
            columns: [

                {
                    data: 'siswa',
                    name: 'siswa'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
                },
                {
                    data: 'column_keluar',
                    name: 'column_keluar',
                    orderable: false,
                    action: false
                },
                {
                    data: 'column_masuk',
                    name: 'column_masuk',
                    orderable: false,
                    action: false
                },
                /* {
                     data: 'keluar',
                     name: 'keluar',
                     render: function(data) {
                         if (data == 'Y') {
                             return "Ya";
                         } else {
                             return "Tidak";
                         }
                     }
                 },

                 {
                     data: 'masuk',
                     name: 'masuk',
                     render: function(data) {
                         if (data == 'Y') {
                             return "Ya";
                         } else {
                             return "Tidak";
                         }
                     }

                 },
                 /*  {
                       data: 'tidak_masuk',
                       name: 'tidak_masuk',
                       render: function(data) {
                           if (data == 'Y') {
                               return "Ya";
                           } else {
                               return "Tidak";
                           }
                       }
                   },
                {
                    data: 'jam',
                    name: 'jam'
                },   */
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,

                }
            ]
        });

    });


    /* $('.modal-footer').on('click', '#button_action', function() {
         //event.preventDefault();
         var form_data = $.fn.editable.defaults.mode = 'inline';$(this).serialize();
         //var id = $(this).attr("id");

         $.ajax({
             url: "{{route('pgerbang.pgerbang.store')}}",
             method: 'POST',
             data: form_data,
             dataType: 'json',
             success: function(data) {
                 if (data.error.length > 0) {
                     var error_html = '';
                 contacts/update    for (var count = 0; cout < data.error.length; count++) {
                         error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                     }
                     $('#form_output').html(error_html);

                 } else {
                     $('#form_output').html(data.success);
                     $('#absen_form').modal('hide');
                     $('#dataTable').DataTable().ajax.reload();

                 }

             }

         })
     })

     $(document).on('click', '.edit', function() {
         var id = $(this).attr("id");
         $.ajax({
             url: "{{route('pgerbang.pgerbang.edit'," + id + ")}}",

             method: 'get',
             data: {
                 'id': id
             },
             dataType: 'json',

             success: function(data) {
                 $('#izin_id').val(id);
                 $('#masuk').val(data.masuk);
                 $('#keluar').val(data.keluar);
                 $('#tidak_masuk').val(data.tidak_masuk);
                 $('#absenModal').modal('show');
             }

         })

     })*/
   
</script>
@endsection