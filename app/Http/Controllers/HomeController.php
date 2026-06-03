<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\Twitter;
use Artesaos\SEOTools\Facades\JsonLd;

class HomeController extends Controller
{
    //

    public function index()
    {

        return view('pages.home.index');
    }
}
