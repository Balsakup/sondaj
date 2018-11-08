<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>

    <a href="{{ route('admin::dashboard.home') }}" class="navbar-brand">
        <span class="navbar-brand-full">{{ config('app.name', 'Sondaj') }}</span>
        <span class="navbar-brand-minimized">
            <span class="fa fa-poll"></span>
        </span>
    </a>

    <div class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <div class="navbar-toggler-icon"></div>
    </div>

    <ul class="nav navbar-nav d-md-down-none">
        {{--<li class="nav-item px-3">
            <a href="#" class="nav-link">ITEM</a>
        </li>--}}
    </ul>

    <ul class="nav navbar-nav ml-auto">

    </ul>

    <button class="navbar-toggler aside-menu-toggler d-md-down-none" type="button" data-toggle="aside-menu-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>

    <button class="navbar-toggler aside-menu-toggler d-lg-none" type="button" data-toggle="aside-menu-show">
        <span class="navbar-toggler-icon"></span>
    </button>
</header>
