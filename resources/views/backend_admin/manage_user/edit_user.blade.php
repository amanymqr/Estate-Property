@extends('admin.admin_dashboard')
@section('title', 'Add user ')
@section('content')
    <div class="page-content">

        <div class="row profile-body">


            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="card">
                            <div class="card-body">

                                <h6 class="card-title">Edit user </h6>
                                <form method="POST" id="myForm"
                                    action="{{ route('manage_user.update', $all_user->id) }}" class="forms-sample">
                                    @csrf
                                    @method('PUT')


                                    <div class="form-group mb-3">
                                        <label for="exampleInputEmail1" class="form-label">user Name </label>
                                        <input type="text" name="name" value="{{ $all_user->name }}"
                                            class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                            <small class="text-danger ">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="exampleInputEmail1" class="form-label">user Email </label>
                                        <input type="email" name="email" value="{{ $all_user->email }}"
                                            class="form-control  @error('email') is-invalid @enderror">
                                        @error('email')
                                            <small class="text-danger ">{{ $message }}</small>
                                        @enderror
                                    </div>


                                    <div class="form-group mb-3">
                                        <label for="exampleInputEmail1" class="form-label">user Phone </label>
                                        <input type="text" name="phone" value="{{ $all_user->phone }}"
                                            class="form-control @error('phone') is-invalid @enderror">
                                        @error('phone')
                                            <small class="text-danger ">{{ $message }}</small>
                                        @enderror
                                    </div>



                                    <div class="form-group mb-3">
                                        <label for="exampleInputEmail1" class="form-label">user Address </label>
                                        <input type="text" name="address" value="{{ $all_user->address }}"
                                            class="form-control">
                                    </div>



                                    <button type="submit" class="btn btn-primary me-2">Edit user</button>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

@stop
