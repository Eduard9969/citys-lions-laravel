<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="@if(!empty($admin_area)) {{ route('admin.dashboard') }} @else {{ url('/') }} @endif">
            {{ config('app.name', 'Laravel') }} @if(!empty($admin_area)) Admin Dash @endif
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        @if(Auth::user()->first_name) {{ Auth::user()->first_name }} @else {{ Auth::user()->login }} @endif <span class="caret"></span>
                    </a>

                    @include('components.menus.userdropdown')
                </li>
            </ul>
        </div>
    </div>
</nav>
