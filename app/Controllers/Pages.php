<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function about()
    {
        return view('pages/about', ['title' => 'About']);
    }
}
