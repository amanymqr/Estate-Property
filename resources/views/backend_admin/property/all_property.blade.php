@extends('admin.admin_dashboard')
@section('title', 'All Property ')
@section('content')


    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('property.create') }}" class="btn btn-inverse-info"> Add Property </a>

            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Property</h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Image </th>
                                        <th>Name </th>
                                        <th>Property Type </th>
                                        <th>Status Type </th>
                                        <th>City </th>
                                        <th>Status </th>
                                        <th>Action </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($property as $key => $property)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td><img src="{{ asset($property->property_thambnail) }}"
                                                    style="width:70px; height:40px;"> </td>
                                            <td>{{ $property->property_name }}</td>
                                            <td>{{ $property->ptype_id }}</td>
                                            <td>{{ $property->property_status }}</td>
                                            <td>{{ $property->city }}</td>
                                            <td>
                                                @if ($property->status == 1)
                                                    <span class="badge rounded-pill bg-success">Active</span>
                                                @else
                                                    <span class="badge rounded-pill bg-danger">InActive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href=""
                                                    class="btn btn-inverse-warning">Edit</a>


                                                <form method="post" action=""
                                                    id="deleteForm" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-inverse-danger">Delete</button>

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
