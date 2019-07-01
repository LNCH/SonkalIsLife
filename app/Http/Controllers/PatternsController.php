<?php

namespace App\Http\Controllers;

use App\Pattern;
use Illuminate\Http\Request;

class PatternsController extends Controller
{
    public function store(Request $request)
    {
        Pattern::create($request->all());

        return redirect(route('admin.patterns.index'));
    }
}
