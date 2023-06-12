<nav class="navbar navbar-expand-md navbar-light shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bolder" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">

                <!-- Authentication Links -->
                @guest
                @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}" style="font-size:25px;"><i class="bi bi-person-fill"></i></a>
                </li>
                @endif

                <!-- @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}" style="font-size:25px;"><i class="bi bi-person-plus"></i></a>
                </li>
                @endif -->

                @else
                <li class="nav-item dropdown me-3">
                    @include('components.notifications')
                </li>

                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                        @if(Auth::user()->user_type=='admin' && Request::is('/'))
                        <a class="dropdown-item" href="{{ url('/admin') }}">
                            Admin
                        </a>
                        @endif
                        @if(Auth::user()->user_type=='employee' && Request::is('/'))
                        <a class="dropdown-item" href="{{ url('/employee') }}">
                            Employee
                        </a>
                        @endif

                        @if(Request::is('admin*') || Request::is('employee*'))
                        <a class="dropdown-item" href="{{ url('/') }}">
                            Home
                        </a>
                        @endif

                    </div>
                </li>

                @endguest
            </ul>
        </div>
    </div>
</nav>