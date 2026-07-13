<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class AssetsController extends Controller
{
    public function view(string $id): RedirectResponse
    {
        //dd($id);
        return redirect()->route('properties.show', ['property' => $id]);
    }
}
