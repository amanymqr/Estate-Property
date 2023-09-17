@extends('admin.admin_dashboard')
@section('title', 'All Agent ')
@section('content')


    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('manage_agent.create') }}" class="btn btn-inverse-info"> Add Agent </a>

            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Agent</h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl </th>
                                        <th>Image </th>
                                        <th>Name </th>
                                        <th>Role </th>
                                        <th>Status </th>
                                        <th>Change </th>
                                        <th>Action </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($all_agent as $key => $agent)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td><img src="{{ !empty($agent->photo) ? url('upload/agent_images/' . $agent->photo) : url('upload/no_image.jpg') }}"
                                                    style="width:50px; height:40px;"> </td>
                                            <td>{{ $agent->name }}</td>
                                            <td>{{ $agent->role }}</td>
                                            <td>
                                                @if ($agent->status == 'active')
                                                    <span class="badge rounded-pill bg-success">Active</span>
                                                @else
                                                    <span class="badge rounded-pill bg-danger">InActive</span>
                                                @endif
                                            </td>

                                            <td>
                                                <input data-id="{{ $agent->id }}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger"  data-toggle="toggle" data-on="Active" data-off="Inactive" {{ $agent->status ? 'checked' : '' }} >
                                            </td>

                                            <td>

                                                <a href="{{ route('manage_agent.edit', $agent->id) }}"
                                                    class="btn text-info btn-sm"><i data-feather="edit"></i></a>
                                                <form method="post"
                                                    action="{{ route('manage_agent.destroy', $agent->id) }}" id="deleteForm"
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
