<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class Permission extends Model
{
	use HasFactory, HasRoles;
	protected $guarded = [];

	public function scopeFilter($query, array $filters)
	{
		$query->when($filters['search'] ?? false, function ($query, $search) {
			return $query->where('name', 'like', '%' . $search . '%');
		});
	}

	public function roles()
	{
		return $this->belongsToMany(Role::class, 'role_has_permissions');
	}
}
