@extends('admin.admin_dashboard')
@section('title', 'Add Amenities ')
@section('content')
    <div class="page-content">

        <div class="row profile-body">


            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="card">
                            <div class="card-body">

                                <h6 class="card-title">Add Amenities </h6>

                                <form method="POST" action="{{ route('amenities.store') }}"
                                    class="forms-sample">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputUsername1" class="form-label">Amenities Name</label>
                                        <input type="text" name="amenities_name"
                                            class="form-control @error('amenities_name') is-invalid @enderror"
                                            id="exampleInputUsername1" autocomplete="amenities_name" placeholder="amenities name">

                                        @error('amenities_name')
                                            <small class="text-danger ">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary me-2">Add Amenities</button>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>


@stop
