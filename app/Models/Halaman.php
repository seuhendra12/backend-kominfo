<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Halaman extends Model
{
  use SoftDeletes;

  protected $table = 'halamans';
  protected $dates = ['deleted_at'];
  protected $guarded = [];

  public static function boot()
  {
    parent::boot();

    static::deleting(function ($content) {
      $content->status = 'inactive';
      $content->save();
    });

    static::deleting(function ($halaman) {
      $history = new HalamanHistori();
      $history->halaman_id = $halaman->id;
      $history->save();
    });

    static::restoring(function ($halaman) {
      $history = HalamanHistori::where('halaman_id', $halaman->id);
      $history->forceDelete();
    });
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
