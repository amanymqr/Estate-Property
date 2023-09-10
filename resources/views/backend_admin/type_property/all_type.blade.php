@extends('admin.admin_dashboard')
@section('title', 'All Property Type')
@section('content')


    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('propertyType.create') }}" class="btn btn-inverse-info"> Add Property Type </a>

            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Property All Type</h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>S1</th>
                                        <th>Type</th>
                                        <th>Icon</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($types as $key => $type)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $type->type_name }}</td>
                                            <td>{{ $type->type_icon }}</td>
                                            <td>
                                                <a href="{{ route('propertyType.edit', $type->id) }}"
                                                    class="btn btn-inverse-warning">Edit</a>


                                                <form method="post"
                                                    action="{{ route('propertyType.destroy', $type->id) }}" id="deleteForm" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                    class="btn btn-inverse-danger">Delete</button>

                                                </form>



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
