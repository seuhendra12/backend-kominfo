<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Konten;
use Illuminate\Http\Request;

class KontenController extends Controller
{
  public function index()
  {
    $kontens = Konten::all();

    return response()->json([
      'data' => $kontens,
    ]);
  }
}
