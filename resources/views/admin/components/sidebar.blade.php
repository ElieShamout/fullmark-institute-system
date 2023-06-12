<div class="sidebar-content">
    <div class='sidebar-title text-muted text-center pt-3 pb-2 border-bottom d-flex align-items-center'>
        <h5>Sidebar</h5>
        <div class="sidebar-btn ms-auto"><i class="bi bi-x"></i></div>
    </div>
    <ul class='list-unstyled text-light sidebar-list p-0 m-0'>

        <!-- @if(Request::path()=='admin')
        <a href="{{url('/admin')}}">
            <li class='sidebar-item text-dark' style="background-color:#ffbf11"> <i class="icon bi bi-card-list"></i> start </li>
        </a>
        @else
        <a  href="{{url('/admin')}}" style="background-color:#ffbf11">
            <li class='sidebar-item'> <i class="icon bi bi-card-list"></i>start </li>
        </a>
        @endif -->
        @if(Request::path()=='admin/new-lesson')
        <a href="{{url('/admin/new-lesson')}}" style="background-color:#ffbf11">
            <li class='sidebar-item text-dark' style="background-color:#ffbf11"> <i class="icon bi bi-plus-square"></i> New Lesson</li>
        </a>
        @else
        <a href="{{url('/admin/new-lesson')}}">
            <li class='sidebar-item'> <i class="icon bi bi-plus-square"></i> New Lesson</li>
        </a>
        @endif

        @if(Request::path()=='admin/techers')
        <a href="{{url('/admin/techers')}}" style="background-color:#ffbf11">
            <li class='sidebar-item text-dark' style="background-color:#ffbf11"> <i class="icon bi bi-journal-bookmark-fill"></i> techers</li>
        </a>
        @else
        <a href="{{url('/admin/techers')}}">
            <li class='sidebar-item'> <i class="icon bi bi-journal-bookmark-fill"></i> techers </li>
        </a>
        @endif


        @if(Request::path()=='admin/students')
        <a href="{{url('/admin/students')}}" style="background-color:#ffbf11">
            <li class='sidebar-item text-dark' style="background-color:#ffbf11"> <i class="icon bi bi-person"></i> students</li>
        </a>
        @else
        <a href="{{url('/admin/students')}}">
            <li class='sidebar-item'> <i class="icon bi bi-person"></i> students </li>
        </a>
        @endif

        @if(Request::path()=='admin/lessons')
        <a href="{{url('/admin/lessons')}}" style="background-color:#ffbf11">
            <li class='sidebar-item text-dark' style="background-color:#ffbf11"> <i class="icon bi bi-calendar3"></i> lessons</li>
        </a>
        @else
        <a href="{{url('/admin/lessons')}}">
            <li class='sidebar-item'> <i class="icon bi bi-calendar3"></i> lessons </li>
        </a>
        @endif

        @if(Request::path()=='admin/subjects')
        <a href="{{url('/admin/subjects')}}" style="background-color:#ffbf11">
            <li class='sidebar-item text-dark' style="background-color:#ffbf11"> <i class="icon bi bi-book"></i> Subjects</li>
        </a>
        @else
        <a href="{{url('/admin/subjects')}}">
            <li class='sidebar-item'> <i class="icon bi bi-book"></i> Subjects </li>
        </a>
        @endif

        @if(Request::path()=='admin/payment')
        <a href="{{url('/admin/payment')}}" style="background-color:#ffbf11">
            <li class='sidebar-item text-dark' style="background-color:#ffbf11"> <i class="icon bi bi-credit-card"></i> Payment</li>
        </a>
        @else
        <a href="{{url('/admin/payment')}}">
            <li class='sidebar-item'> <i class="icon bi bi-credit-card"></i> Payment</li>
        </a>
        @endif

        @if(Request::path()=='admin/levels')
        <a href="{{url('/admin/levels')}}" style="background-color:#ffbf11">
            <li class='sidebar-item text-dark' style="background-color:#ffbf11"> <i class="icon bi bi-list"></i> Levels</li>
        </a>
        @else
        <a href="{{url('/admin/levels')}}">
            <li class='sidebar-item'> <i class="icon bi bi-list"></i> Levels </li>
        </a>
        @endif

        @if(Request::path()=='admin/statistics')
        <a href="{{url('/admin/statistics')}}" style="background-color:#ffbf11">
            <li class='sidebar-item text-dark' style="background-color:#ffbf11"> <i class="icon bi bi-bar-chart-line"></i> statistics</li>
        </a>
        @else
        <a href="{{url('/admin/statistics')}}">
            <li class='sidebar-item'> <i class="icon bi bi-bar-chart-line"></i> statistics </li>
        </a>
        @endif


        @if(Request::path()=='admin/add-new-admin')
        <a href="{{url('/admin/add-new-admin')}}" style="background-color:#ffbf11">
            <li class='sidebar-item text-dark' style="background-color:#ffbf11"> <i class="icon bi bi-person-plus"></i> Add new admin </li>
        </a>
        @else
        <a href="{{url('/admin/add-new-admin')}}">
            <li class='sidebar-item'> <i class="icon bi bi-person-plus"></i> Add new admin </li>
        </a>
        @endif



    </ul>
</div>