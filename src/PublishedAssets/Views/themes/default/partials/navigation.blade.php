<nav class="navbar navbar-default navbar-fixed-top clearfix">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navBar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('') }}">Home</a>
        </div>
        <div class="collapse navbar-collapse" id="navBar">
            <ul class="nav navbar-nav">
                <li><a href="{{ url('page/welcome') }}">Welcome</a></li>
                <li><a href="{{ url('blog') }}">Blog</a></li>
                <li><a href="{{ url('gallery') }}">Gallery</a></li>
                <li><a href="{{ url('faqs') }}">FAQs</a></li>
                <li><a href="{{ url('events') }}">Events</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right menu">
                @if (config('app.locale') == 'fr')
                    @menu('main-fr')
                @else
                    @menu('main')
                @endif
            </ul>
        </div>
    </div>
</nav>