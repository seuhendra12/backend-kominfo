<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
  public function index()
  {
    $tags = Tag::all();

    return response()->json([
      'data' => $tags,
    ]);
  }
}
