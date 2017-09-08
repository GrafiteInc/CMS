<?php

if (!function_exists('sortable')) {
    function sortable($label, $field)
    {
        $query = request()->query();
        $newQuery = $query;

        foreach (['field', 'dir'] as $value) {
            if (isset($newQuery[$value])) {
                unset($newQuery[$value]);
            }
        }

        $newQuery['field'] = $field;
        $newQuery['dir'] = 'asc';

        if (isset($query['field']) && $query['field'] == $field && $query['dir'] == 'asc') {
            $newQuery['dir'] = 'desc';
        }

        return '<a href="'.request()->url().'?'.http_build_query($newQuery).'">'.$label.' <span class="fa fa-sort"></span></a>';
    }
}

if (!function_exists('redirectToQuarxRoute')) {
    function redirectToQuarxRoute($route, $parameters = [], $status = 302, $headers = [])
    {
        return redirect(route(config('quarx.backend-route-prefix', 'quarx').".$route"), $parameters, $status, $headers);
    }
}