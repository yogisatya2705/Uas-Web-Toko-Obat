<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RoleTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('roles')->insert([
      'name' => 'ROLE_ADMIN',
      'description' => 'User dengan permission Admin',
      'created_at' => Carbon::now()->format('Y-m-d H:i:s')
    ]);
    DB::table('roles')->insert([
      'name' => 'ROLE_MEMBER',
      'description' => 'User dengan permission Member',
      'created_at' => Carbon::now()->format('Y-m-d H:i:s')
    ]);
  }
}
