<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasPermissions; // Import class HasPermissions
use App\Models\Permission;
use Spatie\Permission\Traits\HasRoles;


class Role extends Model
{
	use HasFactory;
	use HasPermissions; // Gunakan trait HasPermissions
	use HasRoles;

	protected $guarded = [];

	public function scopeFilter($query, array $filters)
	{
		$query->when($filters['search'] ?? false, function ($query, $search) {
			return $query->where('name', 'like', '%' . $search . '%');
		});
	}

	public function permissions()
	{
		return $this->belongsToMany(Permission::class, 'role_has_permissions');
	}
}
