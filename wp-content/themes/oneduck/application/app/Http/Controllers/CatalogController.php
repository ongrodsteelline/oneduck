<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogController
{
    public function index(Request $request)
    {
        return view('catalog.index');
    }

    public function categories(Request $request, $categories)
    {
        $categories = explode('/', $categories);
        dd($categories);
    }
}