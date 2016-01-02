<?php

namespace Mlantz\Quarx\Controllers;

class HelpController extends QuarxController
{
    public function main()
    {
        return view('quarx::help');
    }
}