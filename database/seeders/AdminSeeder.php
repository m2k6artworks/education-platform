<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // 🔥 Hapus user lama jika sudah ada
        $existingAdmin = User::where('email', 'admin@edu.com')->first();
        if ($existingAdmin) {
            $existingAdmin->delete();
        }

        // 🆕 Buat user admin baru
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@edu.com',
            'password' => bcrypt('admin123'),
        ]);

        // 🛡️ Assign role admin
        $admin->assignRole('admin');
    }
}