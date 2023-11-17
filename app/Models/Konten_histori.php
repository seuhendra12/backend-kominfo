<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Konten_histori extends Model
{
  use HasFactory;

  public function konten()
  {
    return $this->belongsTo(Konten::class, 'konten_id');
  }

  public function scopeFilter($query, array $filters)
  {
    $query->when($filters['search'] ?? false, function ($query, $search) {
      return $query->where('name', 'like', '%' . $search . '%');
    });
  }
  public function getFormattedPublishedAtAttribute()
  {
    return Carbon::parse($this->tanggal_terbit)
      ->locale('id_ID')
      ->isoFormat('D MMMM YYYY');
  }

  public function publishedTime()
  {
    return Carbon::parse($this->jam_terbit)->format('H:i');
  }

  public function createdDate()
  {
    return Carbon::parse($this->created_at)
      ->locale('id_ID')
      ->isoFormat('D MMMM YYYY');
  }

  public function createdTime()
  {
    return Carbon::parse($this->created_at)->format('H:i');
  }
}
