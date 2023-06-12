<div class="sidebar-content">
    <div class='sidebar-title text-muted text-center pt-3 pb-2 border-bottom d-flex align-items-center'>
        <h5>Sidebar</h5>
        <div class="sidebar-btn ms-auto"><i class="bi bi-list"></i></div>
    </div>
    <ul class='list-unstyled text-light sidebar-list p-0 m-0'>

        @if(Request::path()=='session')
        <a href="{{url('/employee/')}}">
            <li class='sidebar-item text-dark' style="background-color:#FFDE50"> <i class="icon bi bi-plus-square"></i> new session </li>
        </a>
        @else
        <a href="{{url('/employee/')}}">
            <li class='sidebar-item'> <i class="icon bi bi-plus-square"></i> new call </li>
        </a>
        @endif

        @if(Request::path()=='employee/sessions')
        <a href="{{url('/employee/sessions')}}">
            <li class='sidebar-item text-dark' style="background-color:#FFDE50"> <i class="icon bi bi-card-list"></i> my sessions </li>
        </a>
        @else
        <a href="{{url('/employee/sessions')}}" style="background-color:#FFDE50">
            <li class='sidebar-item'> <i class="icon bi bi-card-list"></i> my sessions </li>
        </a>
        @endif

        @if(Request::path()=='session/appointment')
        <a href="{{url('/employee/appointment')}}" style="background-color:#FFDE50">
            <li class='sidebar-item text-dark' style="background-color:#FFDE50"> <i class="icon bi bi-calendar3"></i> Appointment</li>
        </a>
        @else
        <a href="{{url('/employee/appointment')}}">
            <li class='sidebar-item'> <i class="icon bi bi-calendar3"></i> Appointment</li>
        </a>
        @endif

        @if(Request::path()=='employee/export-data')
        <a href="{{url('/employee/export-data')}}" style="background-color:#FFDE50">
            <li class='sidebar-item text-dark' style="background-color:#FFDE50"> <i class="icon bi bi-file-earmark-text"></i> export data 1</li>
        </a>
        @else
        <a href="{{url('/employee/export-data')}}">
            <li class='sidebar-item'> <i class="icon bi bi-file-earmark-text"></i> export data </li>
        </a>
        @endif

        @if(Request::path()=='employee/phone-numbers')
        <a href="{{url('/employee/phone-numbers')}}" style="background-color:#FFDE50">
            <li class='sidebar-item text-dark' style="background-color:#FFDE50"> <i class="icon bi bi-journal-bookmark-fill"></i> my numbers</li>
        </a>
        @else
        <a href="{{url('/employee/phone-numbers')}}">
            <li class='sidebar-item'> <i class="icon bi bi-journal-bookmark-fill"></i> my numbers </li>
        </a>
        @endif

    </ul>
</div>
