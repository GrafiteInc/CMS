<ul class="nav nav-sidebar">
    <li><a href="{!! url('quarx/dashboard') !!}"><span class="fa fa-dashboard"></span> Dashboard</a></li>
    <li><a href="{!! url('quarx/images') !!}"><span class="fa fa-image"></span> Images</a></li>
    <li><a href="{!! url('quarx/files') !!}"><span class="fa fa-file"></span> Files</a></li>
    <li><a href="{!! url('quarx/blog') !!}"><span class="fa fa-pencil"></span> Blog</a></li>
    <li><a href="{!! url('quarx/menus') !!}"><span class="fa fa-link"></span> Menus</a></li>
    <li><a href="{!! url('quarx/pages') !!}"><span class="fa fa-file-text-o"></span> Pages</a></li>
    <li><a href="{!! url('quarx/widgets') !!}"><span class="fa fa-gear"></span> Widgets</a></li>
    <li><a href="{!! url('quarx/faqs') !!}"><span class="fa fa-question"></span> FAQs</a></li>
    {!! ModuleService::menus() !!}
    <li><a href="{!! url('quarx/help') !!}"><span class="fa fa-info-circle"></span> Help</a></li>
</ul>