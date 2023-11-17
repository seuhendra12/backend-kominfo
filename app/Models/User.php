<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable, HasRoles;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'email',
		'level_akses',
		'satuan_kerja',
		'is_active',
		'password',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
		'is_active' => 'boolean',
	];

	public function role()
	{
		return $this->belongsTo(Role::class, 'role_id', 'id');
	}

	public function scopeFilter($query, array $filters)
	{
		$query->when($filters['search'] ?? false, function ($query, $search) {
			return $query->where('name', 'like', '%' . $search . '%');
		});
	}

	public function loginHistories()
	{
		return $this->hasMany(LoginHistory::class);
	}
}
