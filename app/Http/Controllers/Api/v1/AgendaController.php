<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
  public function index()
  {
    $agendas = Agenda::all();

    return response()->json([
      'data' => $agendas,
    ]);
  }
}
