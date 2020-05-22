@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Categories</a>
        </li>
        <li class="breadcrumb-item active">Show Detail</li>
    </ol>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    Category Detail : {{ $category->title }}
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>ID</th>
                            <td>{{ $category->id }}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td>{{ $category->slug }}</td>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td>{{ $category->title }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection