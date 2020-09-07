<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @guest
            @if (Route::has('register'))
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            {{ __('Register') }}
                        </p>
                    </a>
                </li>
            @endif
        @else
        @if(Auth::user()->user_type == 'admin')
            <li class="nav-item">
                <a href="{{ route('admin.users') }}" class="nav-link">
                    <i class="nav-icon fas fa-circle"></i>
                    <p>
                        Manage Users
                    </p>
                </a>
            </li>
            
            @endif

            <li class="nav-item">
                <a href="{{ route('import') }}" class="nav-link">
                    <i class="nav-icon fas fa-circle"></i>
                    <p>
                        Import Records
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('report.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-circle"></i>
                    <p>
                        Reports
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('setting') }}" class="nav-link">
                    <i class="nav-icon fas fa-circle"></i>
                    <p>
                        My Settings
                    </p>
                </a>
            </li>

        @endguest
       


    </ul>
</nav>
