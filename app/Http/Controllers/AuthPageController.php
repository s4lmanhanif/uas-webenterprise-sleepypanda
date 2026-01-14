<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthPageController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query('page', 'landing');
        $allowed = ['landing', 'masuk', 'daftar', 'reset'];

        if (!in_array($page, $allowed, true)) {
            $page = 'landing';
        }

        return view('auth', [
            'page' => $page,
        ]);
    }
}
