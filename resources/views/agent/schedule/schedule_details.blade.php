@extends('agent.agent_dashboard')
@section('title', 'schedule details ')
@section('content')




    <div class="page-content">



        <div class="row">
            <div class="col-md-8">
                <h6 class=" px-3 ">Schedule Request Details </h6>

                <div class="card">


                    <form method="post" action="{{ route('agent.update.schedule') }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $schedule->id }}">
                        <input type="hidden" name="email" value="{{ $schedule->user->email }}">

                        <div class="table-responsive pt-3">
                            <table class="table table-bordered">

                                <tbody>
                                    <tr>
                                        <td>User Name </td>
                                        <td>{{ $schedule->user->name }}</td>

                                    </tr>

                                    <tr>
                                        <td>Property Name </td>
                                        <td>{{ $schedule->property->property_name }}</td>

                                    </tr>


                                    <tr>
                                        <td>Tour Date </td>
                                        <td>{{ $schedule->tour_date }}</td>

                                    </tr>


                                    <tr>
                                        <td>Tour Time </td>
                                        <td>{{ $schedule->tour_time }}</td>

                                    </tr>


                                    <tr>
                                        <td>Message </td>
                                        <td>{{ $schedule->message }}</td>

                                    </tr>

                                    <tr>
                                        <td>Request Send Time </td>
                                        <td>{{ $schedule->created_at->format('l M d Y') }}</td>

                                    </tr>

                                </tbody>
                            </table>
                        </div>

                        <button type="submit" class="btn btn-success mx-auto mx-2 my-2">Request Confirm </button>


                    </form>
                </div>



            </div>
        </div>
    </div>





@stop
