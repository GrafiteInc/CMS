<?php

namespace Mlantz\Quarx\Controllers;

class DashboardController extends QuarxController
{
    public function main()
    {
        return view('quarx::dashboard.main');
    }
}