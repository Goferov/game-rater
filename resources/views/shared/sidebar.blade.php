<div class="sb-sidenav-menu-heading">Konto</div>
<nav class="sb-sidenav-menu-nested">
    <a class="nav-link" href="{{ route('home.mainPage') }}"><div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>Dashboard</a>
</nav>
<div class="sb-sidenav-menu-heading">Konto</div>
<nav class="sb-sidenav-menu-nested">
    <a class="nav-link" href="{{ route('me.profile') }}"><div class="sb-nav-link-icon"><i class="fas fa-gamepad"></i></div>Profil</a>
    <a class="nav-link" href="{{ route('me.games.list') }}"><div class="sb-nav-link-icon"><i class="fas fa-gamepad"></i></div>Gry</a>
</nav>

<div class="sb-sidenav-menu-heading">Gry</div>
<nav class="sb-sidenav-menu-nested">
    <a class="nav-link" href="{{ route('games.list') }}"><div class="sb-nav-link-icon"><i class="fas fa-gamepad"></i></div>Katalog</a>
</nav>

@can('admin-level')
    <div class="sb-sidenav-menu-heading">Admin panel</div>
    <nav class="sb-sidenav-menu-nested">
        <a class="nav-link" href="{{ route('get.users') }}"><div class="sb-nav-link-icon"><i class="fas fa-gamepad"></i></div>Użytkownicy</a>
    </nav>
@endcan
