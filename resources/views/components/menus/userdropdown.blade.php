<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
    @role('admin')
    @if(!empty($admin_area))
        <a href="{{ route('main') }}" target="_blank" class="dropdown-item">
            {{ __('Back to Site') }}
        </a>
    @else
        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
            {{ __('Admin Area') }}
        </a>
    @endif
    <div class="dropdown-divider"></div>
    @endrole

    <a href="{{ route('user.user') }}" class="dropdown-item">
        {{ __('Profile') }}
    </a>
    <a href="{{ route('user.settings') }}" class="dropdown-item">
        {{ __('Settings') }}
    </a>

    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="{{ route('logout') }}"
       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
