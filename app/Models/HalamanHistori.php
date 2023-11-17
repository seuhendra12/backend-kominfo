<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HalamanHistori extends Model
{
  use HasFactory;

  public function halaman()
  {
    return $this->belongsTo(Halaman::class, 'halaman_id');
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
