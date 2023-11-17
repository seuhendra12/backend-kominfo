<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
  public function index()
  {
    $galeris = Galeri::all();

    return response()->json([
      'data' => $galeris,
    ]);
  }
}
