<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Konten extends Model
{
  use HasFactory;
  use SoftDeletes;


  protected $dates = ['deleted_at'];
  protected $guarded = [];

  public static function boot()
  {
    parent::boot();

    static::deleting(function ($content) {
      $content->status = 'inactive';
      $content->save();
    });

    static::deleting(function ($konten) {
      $history = new Konten_histori();
      $history->konten_id = $konten->id;
      $history->save();
    });

    static::restoring(function ($konten) {
      $history = Konten_histori::where('konten_id', $konten->id);
      $history->forceDelete();
    });
  }

  public function scopeFilter($query, $filters)
  {
    if (isset($filters['year'])) {
      $query->whereYear('created_at', $filters['year']);
    }

    if (isset($filters['category'])) {
      $query->where('kategori_id', $filters['category']);
    }

    if (isset($filters['status'])) {
      $query->where('status', $filters['status']);
    }

    if (isset($filters['from_date'])) {
      $query->whereDate('created_at', '>=', $filters['from_date']);
    }

    if (isset($filters['to_date'])) {
      $query->whereDate('created_at', '<=', $filters['to_date']);
    }

    if (isset($filters['search'])) {
      $query->where(function ($query) use ($filters) {
        $query->where('judul', 'LIKE', '%' . $filters['search'] . '%');
      });
    }

    return $query;
  }

  public function kategori()
  {
    return $this->belongsTo(Kategori::class);
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

  public function deletedDate()
  {
    return Carbon::parse($this->deleted_at)
      ->locale('id_ID')
      ->isoFormat('D MMMM YYYY');
  }

  public function deletedTime()
  {
    return Carbon::parse($this->deleted_at)->format('H:i');
  }
}
