<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Store;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Owner (dapat mengakses semua toko)
        $owner = User::factory()->create([
            'name' => 'Super Owner',
            'email' => 'owner@gmail.com',
            'role' => 'owner',
            'password' => Hash::make('admin1234'),
        ]);

        // Create Purchasing (dapat mengakses semua toko)
        $purchasing = User::factory()->create([
            'name' => 'Wulan Purchasing',
            'email' => 'purchase@gmail.com',
            'role' => 'purchasing',
            'password' => Hash::make('admin1234'),
        ]);

        // Buat beberapa admin toko
        $storeAdmins = [
            [
                'name' => 'Admin Toko Pusat',
                'email' => 'admin.pusat@gmail.com',
                'role' => 'store_admin',
            ],
            [
                'name' => 'Admin Toko Cabang 1',
                'email' => 'admin.cabang1@gmail.com',
                'role' => 'store_admin',
            ],
            [
                'name' => 'Admin Toko Cabang 2',
                'email' => 'admin.cabang2@gmail.com',
                'role' => 'store_admin',
            ],
        ];

        $createdAdmins = [];
        foreach ($storeAdmins as $admin) {
            $createdAdmins[] = User::factory()->create([
                'name' => $admin['name'],
                'email' => $admin['email'],
                'role' => $admin['role'],
                'password' => Hash::make('admin1234'),
            ]);
        }

        // Buat beberapa kasir
        $cashiers = [
            [
                'store' => 'Pusat',
                'users' => [
                    [
                        'name' => 'Kasir 1 Pusat',
                        'email' => 'kasir1.pusat@gmail.com',
                    ],
                    [
                        'name' => 'Kasir 2 Pusat',
                        'email' => 'kasir2.pusat@gmail.com',
                    ],
                ],
            ],
            [
                'store' => 'Cabang 1',
                'users' => [
                    [
                        'name' => 'Kasir 1 Cabang 1',
                        'email' => 'kasir1.cabang1@gmail.com',
                    ],
                ],
            ],
            [
                'store' => 'Cabang 2',
                'users' => [
                    [
                        'name' => 'Kasir 1 Cabang 2',
                        'email' => 'kasir1.cabang2@gmail.com',
                    ],
                ],
            ],
        ];

        $storesCashiers = [];
        foreach ($cashiers as $storeCashier) {
            $storesCashiers[$storeCashier['store']] = [];
            foreach ($storeCashier['users'] as $cashier) {
                $storesCashiers[$storeCashier['store']][] = User::factory()->create([
                    'name' => $cashier['name'],
                    'email' => $cashier['email'],
                    'role' => 'cashier',
                    'password' => Hash::make('admin1234'),
                ]);
            }
        }

        // Buat toko-toko sample
        $stores = [
            [
                'name' => 'Toko Pusat',
                'slug' => 'Pusat',
                'address' => 'Jl. Utama No. 1',
                'phone' => '021-5550001',
                'email' => 'pusat@tokopos.com',
                'description' => 'Toko pusat POS System',
                'is_active' => true,
            ],
            [
                'name' => 'Toko Cabang 1',
                'slug' => 'Cabang 1',
                'address' => 'Jl. Cabang No. 1',
                'phone' => '021-5550002',
                'email' => 'cabang1@tokopos.com',
                'description' => 'Cabang 1 POS System',
                'is_active' => true,
            ],
            [
                'name' => 'Toko Cabang 2',
                'slug' => 'Cabang 2',
                'address' => 'Jl. Cabang No. 2',
                'phone' => '021-5550003',
                'email' => 'cabang2@tokopos.com',
                'description' => 'Cabang 2 POS System',
                'is_active' => true,
            ],
        ];

        foreach ($stores as $key => $storeData) {
            $slug = $storeData['slug'];
            unset($storeData['slug']);

            $store = Store::create($storeData);

            // Assign store admin
            $admin = $createdAdmins[$key];
            $store->users()->attach($admin->id);
            $admin->update(['current_store_id' => $store->id]);

            // Assign kasir ke toko
            if (isset($storesCashiers[$slug])) {
                foreach ($storesCashiers[$slug] as $cashier) {
                    $store->users()->attach($cashier->id);
                    $cashier->update(['current_store_id' => $store->id]);
                }
            }
        }
    }
}
