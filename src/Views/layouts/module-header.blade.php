<div class="col-md-12">
    <nav class="navbar px-0 navbar-light justify-content-between">
        <ul class="navbar-nav">
            @if (Route::has(cms()->route($module.'.create')))
                <li class="nav-item">
                    <a class="btn btn-primary" href="{!! route(cms()->route($module.'.create')) !!}">Add New</a>
                </li>
            @endif
        </ul>
        {!! Form::open(['url' => cms()->url($module.'/search'), 'class' => 'form-inline mt-2']) !!}
            <input class="form-control mr-sm-2" name="term" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        {!! Form::close() !!}
    </nav>
</div>