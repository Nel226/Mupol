<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RestrictionController extends Controller
{
    public function index()
    {
        return view('pages.frontend.partenaires.restrictions.index');
    }
}