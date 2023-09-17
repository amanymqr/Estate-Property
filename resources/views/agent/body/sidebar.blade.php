@php
    $id = Auth::user()->id;
    $agentId = App\Models\User::find($id);
    $status = $agentId->status;
@endphp

<!-- partial:partials/_sidebar.html -->
<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            Agent<span>Panel</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>


            <li class="nav-item">
                <a href="{{ route('agent.dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            @if ($status === 'active')
                <li class="nav-item nav-category">Real Estate</li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#types" role="button" aria-expanded="false"
                        aria-controls="types">
                        <i class="link-icon" data-feather="feather"></i>
                        <span class="link-title">Property Type</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="types">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ route('agent_property.index') }}" class="nav-link">All Type</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('agent_property.create') }}" class="nav-link">Add Type</a>
                            </li>

                        </ul>
                    </div>
                </li>


                <li class="nav-item">
                    <a href="{{ route('buy.package') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Buy Package</span>
                    </a>
                </li>
            @else
            @endif






        </ul>
    </div>
</nav>

<!-- partial -->
