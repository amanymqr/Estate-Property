@extends('admin.admin_dashboard')
@section('title', 'Add Role ')
@section('content')


    <div class="page-content">


        <div class="row profile-body">
            <!-- left wrapper start -->

            <!-- left wrapper end -->
            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">

                            <h6 class="card-title">Add Roles </h6>

                            <form id="myForm" method="POST" action="{{ route('role.store') }}" class="forms-sample">
                                @csrf


                                <div class="form-group mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Roles Name </label>
                                    <input type="text" name="name" class="form-control">

                                </div>



                                <button type="submit" class="btn btn-primary me-2">Save Changes </button>

                            </form>

                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>


@stop
