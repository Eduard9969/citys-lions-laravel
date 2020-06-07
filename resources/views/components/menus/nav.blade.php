<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="@if(!empty($admin_area)) {{ route('admin.dashboard') }} @else {{ url('/') }} @endif">
            {{ config('app.name', 'Laravel') }} @if(!empty($admin_area)) Admin Dash @endif
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Center Side Of Navbar -->
            @if(empty($admin_area))
                <ul class="navbar-nav w-100 text-center mr-auto justify-content-center d-none d-md-flex">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('places.list') }}">{{ __('Places') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('guides.list') }}">{{ __('Guides') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-success" href="{{ route('places.suggest.create') }}">{{ __('Suggest Place') }}</a>
                    </li>
                </ul>
            @endif

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                @if(empty($admin_area))
                    <li class="nav-item d-md-none">
                        <a class="nav-link" href="{{ route('places.list') }}">{{ __('Places') }}</a>
                    </li>
                    <li class="nav-item d-md-none">
                        <a class="nav-link" href="{{ route('guides.list') }}">{{ __('Guides') }}</a>
                    </li>
                    <li class="nav-item d-md-none">
                        <a class="nav-link text-success" href="{{ route('places.suggest.create') }}">{{ __('Suggest Place') }}</a>
                    </li>

                    <li class="mr-md-5 d-md-none"></li>
                @endif

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                  @endif
                @else
                    <!-- Authentication Links -->
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @if(isset(Auth::user()->first_name)) {{ Auth::user()->first_name }} @elseif(isset(Auth::user()->login)) {{ Auth::user()->login }} @endif <span class="caret"></span>
                        </a>

                        @include('components.menus.userdropdown')
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
