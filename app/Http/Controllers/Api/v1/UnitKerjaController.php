<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\UnitKerja;
use Illuminate\Http\Request;

class UnitKerjaController extends Controller
{
  public function index()
  {
    $unitKerjas = UnitKerja::all();

    return response()->json([
      'data' => $unitKerjas,
    ]);
  }
}
