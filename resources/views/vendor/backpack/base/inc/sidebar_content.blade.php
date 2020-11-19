<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('dashboard') }}">
        <i class="nav-icon fa fa-dashboard"></i>
        <span>{{ trans('backpack::base.dashboard') }}</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('elfinder') }}">
        <i class="nav-icon fa fa-files-o"></i>
        <span>{{ trans('backpack::crud.file_manager') }}</span>
    </a>
</li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#">
        <i class="nav-icon fa fa-group"></i>
        <span>Users</span>
    </a>
    <ul class="nav-dropdown-items">
        <li class="nav-item">
            <a class="nav-link" href="{{ backpack_url('user') }}">
                <i class="nav-icon fa fa-user"></i>
                <span>Users</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ backpack_url('role') }}">
                <i class="nav-icon fa fa-group"></i>
                <span>Roles</span>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('quote') }}">
        <i class="nav-icon fa fa-question"></i>
        <span>Quotes</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('feed-source') }}">
        <i class="nav-icon fa fa-question"></i>
        <span>Feed Sources</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('fact') }}">
        <i class="nav-icon fa fa-question"></i>
        <span>Facts</span>
    </a>
</li>
