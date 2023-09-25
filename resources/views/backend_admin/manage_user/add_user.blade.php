@extends('admin.admin_dashboard')
@section('title', 'Add User ')
@section('content')
    <div class="page-content">

        <div class="row profile-body">


            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="card">
                            <div class="card-body">

                                <h6 class="card-title">Add User </h6>

                                <form method="POST" id="myForm" action="{{ route('manage_user.store') }}"
                                    class="forms-sample">
                                    @csrf


                                    <div class="form-group mb-3">
                                        <label for="exampleInputEmail1" class="form-label">User Name </label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                            <small class="text-danger ">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="exampleInputEmail1" class="form-label">User Email </label>
                                        <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror">
                                        @error('email')
                                            <small class="text-danger ">{{ $message }}</small>
                                        @enderror
                                    </div>


                                    <div class="form-group mb-3">
                                        <label for="exampleInputEmail1" class="form-label">User Phone </label>
                                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror">
                                        @error('phone')
                                        <small class="text-danger ">{{ $message }}</small>
                                    @enderror
                                    </div>



                                    <div class="form-group mb-3">
                                        <label for="exampleInputEmail1" class="form-label">User Address </label>
                                        <input type="text" name="address" class="form-control">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="exampleInputEmail1" class="form-label">User Password </label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                                        @error('password')
                                        <small class="text-danger ">{{ $message }}</small>
                                    @enderror
                                    </div>


                                    <button type="submit" class="btn btn-primary me-2">Add User</button>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

@stop
