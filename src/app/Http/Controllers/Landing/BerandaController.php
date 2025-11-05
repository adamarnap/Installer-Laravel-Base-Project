<?php

namespace App\Http\Controllers\Landing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class BerandaController extends Controller
{
    public function __construct() {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('landing.index');
    }

}
