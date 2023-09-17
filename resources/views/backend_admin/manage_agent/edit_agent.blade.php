@extends('admin.admin_dashboard')
@section('title', 'Add Agent ')
@section('content')
    <div class="page-content">

        <div class="row profile-body">


            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="card">
                            <div class="card-body">

                                <h6 class="card-title">Edit Agent </h6>
                                <form method="POST" id="myForm"
                                    action="{{ route('manage_agent.update', $all_agent->id) }}" class="forms-sample">
                                    @csrf
                                    @method('PUT')


                                    <div class="form-group mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Agent Name </label>
                                        <input type="text" name="name" value="{{ $all_agent->name }}"
                                            class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                            <small class="text-danger ">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Agent Email </label>
                                        <input type="email" name="email" value="{{ $all_agent->email }}"
                                            class="form-control  @error('email') is-invalid @enderror">
                                        @error('email')
                                            <small class="text-danger ">{{ $message }}</small>
                                        @enderror
                                    </div>


                                    <div class="form-group mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Agent Phone </label>
                                        <input type="text" name="phone" value="{{ $all_agent->phone }}"
                                            class="form-control @error('phone') is-invalid @enderror">
                                        @error('phone')
                                            <small class="text-danger ">{{ $message }}</small>
                                        @enderror
                                    </div>



                                    <div class="form-group mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Agent Address </label>
                                        <input type="text" name="address" value="{{ $all_agent->address }}"
                                            class="form-control">
                                    </div>



                                    <button type="submit" class="btn btn-primary me-2">Edit Agent</button>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

@stop
