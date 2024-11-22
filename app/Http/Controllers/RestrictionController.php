<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RestrictionController extends Controller
{
    public function index()
    {
        return view('pages.frontend.partenaires.restrictions.index');
    }
}
