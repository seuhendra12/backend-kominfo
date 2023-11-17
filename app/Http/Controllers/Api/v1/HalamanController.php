<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Halaman;
use Illuminate\Http\Request;

class HalamanController extends Controller
{
  public function index()
  {
    $halamans = Halaman::all();

    return response()->json([
      'data' => $halamans,
    ]);
  }
}
