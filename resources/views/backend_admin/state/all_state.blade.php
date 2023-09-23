@extends('admin.admin_dashboard')
@section('title', 'All State ')
@section('content')

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('state.create') }}" class="btn btn-inverse-info"> Add State </a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">State All </h6>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl </th>
                                        <th>State Name </th>
                                        <th>State Image </th>
                                        <th>Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($state as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->state_name }}</td>
                                            <td><img src="{{ asset($item->state_image) }}" style="width:60px;height: 60px;">
                                            </td>
                                            <td>
                                                <a href="{{ route('state.edit', $item->id) }}"
                                                    class="btn btn-inverse-warning"> Edit </a>
                                                <form action="{{ route('state.destroy', $item->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-inverse-danger"
                                                        onclick="return confirm('Are you sure you want to delete this state?')">Delete</button>
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

    </di @stop
