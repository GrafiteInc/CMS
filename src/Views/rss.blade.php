<?xml version="1.0"?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        @foreach($meta as $key => $metaItem)
            @if ($key === 'link')
            <{{ $key }} href="{{ $metaItem }}"></{{ $key }}>
            @elseif ($key === 'title')
            <{{ $key }}>{{ $metaItem }}</{{ $key }}>
            @else
            <{{ $key }}>{{ $metaItem }}</{{ $key }}>
            @endif
        @endforeach
        @foreach($items as $item)
            <item>
                <title>{{ $item->title }}</title>
                <link rel="alternate" href="{{ url(str_plural($module).'/'.$item->url) }}" />
                <id>{{ url($item->id) }}</id>
                <author>
                    <name>{{ optional($item)->author }}</name>
                </author>
                <summary type="html">{!! $item->seo_description !!}</summary>
                <updated>{{ $item->updated_at->toAtomString() }}</updated>
            </item>
        @endforeach
    </channel>
</rss>