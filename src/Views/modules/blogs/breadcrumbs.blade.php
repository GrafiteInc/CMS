<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{!! cms()->url('blog') !!}">Blog</a></li>
            {!! cms()->breadcrumbs($location) !!}
        <li class="active"></li>
    </ol>
</nav>