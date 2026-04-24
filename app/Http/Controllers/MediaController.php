<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Global\MediaRepository;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function Upload(Request $request)
    {
        $rv = MediaRepository::Upload($request);
        return response()->json($rv, 200);
    }
}
