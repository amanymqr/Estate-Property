@extends('admin.admin_dashboard')
@section('title', 'Amenities')
@section('content')


    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('amenities.create') }}" class="btn btn-inverse-info"> Add Amenities  </a>

            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">All Amenities</h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>S1</th>
                                        <th>name</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($amenities as $key => $amenitie)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $amenitie->amenities_name }}</td>
                                            <td>
                                                <a href="{{ route('amenities.edit' , $amenitie->id) }}"
                                                    class="btn btn-inverse-warning">Edit</a>


                                                <form method="post"
                                                    action="{{ route('amenities.destroy' ,$amenitie->id ) }}" id="deleteForm" class="d-inline">
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
