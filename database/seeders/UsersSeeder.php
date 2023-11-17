<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		// Membuat role admin
		$adminRole = Role::create(['name' => 'Super Admin']);

		// Membuat beberapa permission
		$permissions = [
			Permission::create(['name' => 'lihat-user']),
			Permission::create(['name' => 'tambah-user']),
			Permission::create(['name' => 'ubah-user']),
			Permission::create(['name' => 'hapus-user']),
			Permission::create(['name' => 'lihat-employee']),
			Permission::create(['name' => 'tambah-employee']),
			Permission::create(['name' => 'ubah-employee']),
			Permission::create(['name' => 'hapus-employee']),
			Permission::create(['name' => 'lihat-role']),
			Permission::create(['name' => 'tambah-role']),
			Permission::create(['name' => 'ubah-role']),
			Permission::create(['name' => 'hapus-role']),
			Permission::create(['name' => 'lihat-permission']),
			Permission::create(['name' => 'tambah-permission']),
			Permission::create(['name' => 'ubah-permission']),
			Permission::create(['name' => 'hapus-permission']),
			Permission::create(['name' => 'lihat-language']),
			Permission::create(['name' => 'tambah-language']),
			Permission::create(['name' => 'ubah-language']),
			Permission::create(['name' => 'hapus-language']),
			Permission::create(['name' => 'lihat-menu']),
			Permission::create(['name' => 'tambah-menu']),
			Permission::create(['name' => 'ubah-menu']),
			Permission::create(['name' => 'hapus-menu']),
			Permission::create(['name' => 'lihat-activity-log']),
			Permission::create(['name' => 'tambah-activity-log']),
			Permission::create(['name' => 'ubah-activity-log']),
			Permission::create(['name' => 'hapus-activity-log']),
			Permission::create(['name' => 'lihat-tag']),
			Permission::create(['name' => 'tambah-tag']),
			Permission::create(['name' => 'ubah-tag']),
			Permission::create(['name' => 'hapus-tag']),
		];

		// Menambahkan permission ke dalam role admin
		$adminRole->syncPermissions($permissions);

		$user = User::create([
			'name' => 'Super Admin',
			'email' => 'superadmin@gmail.com',
			'level_akses' => 'Editor',
			'is_active' => 1,
			'password' => Hash::make('Admin12345.'),
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now(),
		]);

		$user->assignRole('Super Admin');
	}
}
