@extends('admin.admin_dashboard')
@section('title', 'All Post ')
@section('content')


    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('post.create') }}" class="btn btn-inverse-info"> Add Post </a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Post All </h6>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl </th>
                                        <th>Post Title </th>
                                        <th>Category</th>
                                        <th>Post Image </th>
                                        <th>Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($post as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->post_title }}</td>
                                            <td>{{ $item->category->category_name }}</td>
                                            <td><img src="{{ asset($item->post_image) }}" style="width:70px;height: 40px;">
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('post.edit', $item->id) }}"
                                                        class="btn btn-inverse-warning"> Edit </a>
                                                    <form method="POST" action="{{ route('post.destroy', $item->id) }}"
                                                        class="delete-form" id="deleteForm">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-inverse-danger"
                                                        >Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>





@stop
