@extends('admin.admin_dashboard')
@section('title', 'All Testimonial ')
@section('content')

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('testimonial.create') }}" class="btn btn-inverse-info"> Add Testimonials </a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Testimonials All </h6>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl </th>
                                        <th> Name </th>
                                        <th> Position </th>
                                        <th> Image </th>
                                        <th>Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($testimonial as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->position }}</td>
                                            <td><img src="{{ asset($item->image) }}" style="width:70px;height: 40px;"> </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('testimonial.edit', $item->id) }}" class="btn mx-2 btn-inverse-warning">Edit</a>
                                                    <form action="{{ route('testimonial.destroy', $item->id) }}" method="POST" id="deleteForm">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-inverse-danger" >Delete</button>
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
