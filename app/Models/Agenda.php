<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
  use HasFactory;
  protected $guarded = [];
  protected $fillable = [
    // daftar field lainnya
    'tanggal_mulai',
    'tanggal_selesai',
  ];

  public function scopeFilter($query, array $filters)
  {
    $query->when($filters['search'] ?? false, function ($query, $search) {
      return $query->where(function ($query) use ($search) {
        $query->whereHas('unitKerja', function ($query) use ($search) {
          $query->where('name', 'like', '%' . $search . '%');
        })->orWhere('judul', 'like', '%' . $search . '%');
      });
    });
  }

  public function scopeDateRange($query, $start, $end)
  {
    return $query->where('tanggal_mulai', '>=', $start)
      ->where('tanggal_selesai', '<=', $end);
  }

  public function unitKerja()
  {
    return $this->belongsTo(UnitKerja::class, 'unitKerja_id');
  }
}
