<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a href="{{ route('admin::dashboard.home') }}" class="nav-link">
                    <span class="nav-icon fa fa-tachometer-alt"></span> Tableau de bord
                </a>
            </li>
            <li class="nav-title">Questionnaires</li>
            <li class="nav-item nav-dropdown">
                <a href="{{ route('admin::surveys.index') }}" class="nav-link nav-dropdown-toggle">
                    <span class="nav-icon fa fa-poll"></span> Questionnaires
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a href="{{ route('admin::surveys.index') }}" class="nav-link">
                            <span class="nav-icon fa fa-list"></span> Liste
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin::surveys.create') }}" class="nav-link">
                            <span class="nav-icon fa fa-plus"></span> Ajouter
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
