<div class="card card-dark text-center mt-4">
    @if (request('term'))
        <div class="card-header">Searched for "{!! $term !!}"</div>
    @endif
    <div class="card-body">No {{ $module }} found.</div>
</div>