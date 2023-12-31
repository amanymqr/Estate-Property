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
                                        <th>Code </th>
                                        <th>Status </th>
                                        <th>Action </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($properties as $key => $property)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td><img src="{{ asset($property->property_thambnail) }}"
                                                    style="width:50px; height:40px;"> </td>
                                            <td>{{ $property->property_name }}</td>
                                            <td>{{ $property->propertyType->type_name }}</td>
                                            <td>{{ $property->property_status }}</td>
                                            <td>{{ $property->city }}</td>
                                            <td>{{ $property->property_code }}</td>

                                            <td>
                                                @if ($property->user->status == 'active')
                                                    <span class="badge rounded-pill bg-success">Active</span>
                                                @else
                                                    <span class="badge rounded-pill bg-danger">InActive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('property.show', $property->id) }}"
                                                    class="btn btn-inverse-info "><i data-feather="eye"></i></a>

                                                    <a href="{{ route('property.edit', $property->id) }}"
                                                        class="btn btn-inverse-warning "><i data-feather="edit"></i></a>

                                                <form method="post" action="{{ route('property.destroy' ,$property->id) }}"
                                                    id="deleteForm" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-inverse-danger "><i data-feather="trash"></i></button>

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
