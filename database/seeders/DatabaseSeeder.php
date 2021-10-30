<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Itempajak;
use App\Models\Pajak;
use App\Models\User;
use App\Models\Kategori;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
		
		
		User::create([
			'name' => 'Administrator',
			'email' => 'user@gmail.com',
			'email_verified_at' => now(),
			'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
			'remember_token' => md5('Administrator'),
		]);


        // Pajak::factory(3)->create();
        // Kategori::factory(3)->create();
        User::factory(2)->create();
        Item::factory(2)->create();


        Kategori::create([
			'name' => 'Batik Pria',
			'slug' => 'batik-pria',
		]);

        Kategori::create([
			'name' => 'Batik Wanita',
			'slug' => 'batik-wanita',
		]);

        Kategori::create([
			'name' => 'Jaket Pria',
			'slug' => 'jaket-pria',
		]);

        Pajak::create([
			'name' => 'Pph',
			'rate' => '5',
		]);

        Pajak::create([
			'name' => 'Ppn',
			'rate' => '10',
		]);

        Pajak::create([
			'name' => 'Pajak Toko',
			'rate' => '10',
		]);

		Itempajak::create([
			'item_id' => '1',
			'pajak_id' => '1',
		]);

		Itempajak::create([
			'item_id' => '1',
			'pajak_id' => '2',
		]);

		Itempajak::create([
			'item_id' => '2',
			'pajak_id' => '2',
		]);
		
		Itempajak::create([
			'item_id' => '2',
			'pajak_id' => '3',
		]);
        
        

        
    }
}
