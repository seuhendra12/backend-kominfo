<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
  public function index()
  {
    $kategoris = Kategori::all();

    return response()->json([
      'data' => $kategoris,
    ]);
  }
}
