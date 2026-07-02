<?php

namespace App\Http\Controllers;

class AssetsController extends Controller
{
    //

    public function view($id)
    {
        // dd($id);
        return redirect()->route('properties.show', ['property' => $id]);
    }
}
