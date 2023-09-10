@extends('admin.admin_dashboard')
@section('title', 'Edit Amenities')
@section('content')
    <div class="page-content">

        <div class="row profile-body">


            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="card">
                            <div class="card-body">

                                <h6 class="card-title">Edit Amenities</h6>

                                <form method="POST" action="{{ route('amenities.update' ,$amenities->id ) }}" class="forms-sample">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="id" value="{{ $amenities->id }}">
                                    <div class="mb-3">
                                        <label for="exampleInputUsername1" class="form-label">Type Name</label>
                                        <input type="text" name="amenities_name"
                                            class="form-control @error('amenities_name') is-invalid @enderror"
                                            id="exampleInputUsername1" value="{{ $amenities->amenities_name }}"
                                            autocomplete="amenities_name" placeholder="type name">

                                        @error('amenities_name')
                                            <small class="text-danger ">{{ $message }}</small>
                                        @enderror
                                    </div>





                                    <button type="submit" class="btn btn-primary me-2">Update Amenities</button>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>


@stop
