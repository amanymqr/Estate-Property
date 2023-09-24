@extends('admin.admin_dashboard')
@section('title', 'All Permission ')
@section('content')



    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('permission.create') }}" class="btn btn-inverse-info"> Add Permission </a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Permission All </h6>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl </th>
                                        <th>Permission Name </th>
                                        <th>Group Name </th>
                                        <th>Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->group_name }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('permission.edit', $item->id) }}" class="btn btn-inverse-warning">Edit</a>
                                                    <form method="POST" action="{{ route('permission.destroy', $item->id) }}" id="deleteForm" class="d-flex">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-inverse-danger position-absolute" id="delete">Delete</button>
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
