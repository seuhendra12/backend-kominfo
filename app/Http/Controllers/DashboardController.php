<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Konten;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index()
  {
    return view ('dashboard.index', [
      'kontens' => Konten::all(),
      'users' => User::all(),
      'agendas' => Agenda::all()
    ]);
  }
}
