<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  public function run()
  {
    // \App\Models\User::factory(10)->create();
    User::factory()->times(1)->create([
      'name'  => 'Super Admin',
      'email' => 'superadmin@admin.net',
      'password' => bcrypt('superadmin')
    ]);

    Project::factory()->times(40)->create();
  }
}
