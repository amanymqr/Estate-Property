@extends('admin.admin_dashboard')
@section('title', 'Add Property Type')
@section('content')
    <div class="page-content">

        <div class="row profile-body">


            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="card">
                            <div class="card-body">

                                <h6 class="card-title">Add Property Type</h6>

                                <form method="POST" action="{{ route('propertyType.store') }}"
                                    class="forms-sample">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputUsername1" class="form-label">Type Name</label>
                                        <input type="text" name="type_name"
                                            class="form-control @error('type_name') is-invalid @enderror"
                                            id="exampleInputUsername1" autocomplete="type_name" placeholder="type name">

                                        @error('type_name')
                                            <small class="text-danger ">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputUsername1" class="form-label">Type Name</label>
                                        <input type="text" name="type_icon"
                                            class="form-control @error('type_icon') is-invalid @enderror"
                                            id="exampleInputUsername1" autocomplete="type_icon" placeholder="type icon">

                                        @error('type_icon')
                                            <small class="text-danger ">{{ $message }}</small>
                                        @enderror
                                    </div>



                                    <button type="submit" class="btn btn-primary me-2">Add Property</button>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>


@stop
