<div class="col-md-12">
    <nav class="navbar px-0 navbar-light justify-content-between">
        <ul class="navbar-nav">
            @if (Route::has(cms()->route($module.'.create')))
                <li class="nav-item">
                    <a class="btn btn-primary" href="{!! route(cms()->route($module.'.create')) !!}">Add New</a>
                </li>
            @endif
        </ul>
    </nav>
</div>