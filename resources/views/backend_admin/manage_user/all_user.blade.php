@extends('admin.admin_dashboard')
@section('title', 'All User ')
@section('content')


    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('manage_user.create') }}" class="btn btn-inverse-info"> Add user </a>

            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">user</h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl </th>
                                        <th>Image </th>
                                        <th>Name </th>
                                        <th>Role </th>
                                        <th>Email </th>
                                        <th>Phone </th>
                                        <th>Adress </th>
                                        <th>Action </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($all_user as $key => $user)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td><img src="{{ !empty($user->photo) ? url('upload/user_images/' . $user->photo) : url('upload/no_image.jpg') }}"
                                                    style="width:50px; height:40px;"> </td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->address }}</td>


                                            <td>

                                                <a href="{{ route('manage_user.edit', $user->id) }}"
                                                    class="btn text-info btn-sm"><i data-feather="edit"></i></a>
                                                <form method="post"
                                                    action="{{ route('manage_user.destroy', $user->id) }}" id="deleteForm"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn text-danger btn-sm"><i
                                                            data-feather="trash"></i></button>
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
@section('scripts')
    <script type="text/javascript">
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var user_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/changeStatus',
                    data: {
                        'status': status,
                        'user_id': user_id
                    },
                    success: function(data) {
                        // console.log(data.success)

                        // Start Message

                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        if ($.isEmptyObject(data.error)) {

                            Toast.fire({
                                type: 'success',
                                title: data.success,
                            })

                        } else {

                            Toast.fire({
                                type: 'error',
                                title: data.error,
                            })
                        }

                        // End Message


                    }
                });
            })
        })
    </script>
@endsection
@stop
