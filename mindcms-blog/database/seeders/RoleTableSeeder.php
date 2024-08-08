<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $adminRole = Role::create([
            'name' => 'admin',
            'display_name' => 'Adminstrator',
            'description' => 'System Adminstrator',
            'allowed_route' => 'admin'
        ]);

        $editorRole = Role::create([
            'name' => 'editor',
            'display_name' => 'Supervisor',
            'description' => 'System Supervisor',
            'allowed_route' => 'admin'
        ]);

        $userRole = Role::create([
            'name' => 'user',
            'display_name' => 'User',
            'description' => 'Normal User',
            'allowed_route' => null
        ]);

        $admin = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@bloggi.test',
            'mobile' => '0771015417',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('123123123'),
            'status' => 1,
            ]);

        $admin->attachRole($adminRole);

        $editor = User::create([
            'name' => 'Editor',
            'username' => 'editor',
            'email' => 'editor@bloggi.test',
            'mobile' => '0675388002',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('123123123'),
            'status' => 1,
        ]);

        $editor->attachRole($editorRole);

        $user1 = User::create(['name' => 'samer amri', 'username' => 'Sameramri54', 'email' => 'amrisamer54@bloggi.test', 'mobile' => '0771015418', 'email_verified_at' => Carbon::now(), 'password' => bcrypt('123123123'), 'status' => 1,]);
        $user1->attachRole($userRole);
        $user2 = User::create(['name' => 'hana ben said', 'username' => 'hayoo07', 'email' => 'hanaben07@bloggi.test', 'mobile' => '0771015443', 'email_verified_at' => Carbon::now(), 'password' => bcrypt('123123123'), 'status' => 1,]);
        $user2->attachRole($userRole);
        $user3 = User::create(['name' => 'onax xano', 'username' => 'onax55', 'email' => 'onax@bloggi.test', 'mobile' => '0771015432', 'email_verified_at' => Carbon::now(), 'password' => bcrypt('123123123'), 'status' => 1,]);
        $user3->attachRole($userRole);

        for ($i = 0; $i < 10; $i++) {
            $user = User::create([
                                    'name' => $faker->name,
                                    'username' => $faker->userName,
                                    'email' => $faker->email,
//                                  'mobile' => '956' . random_int(100000, 999999),
                                    'mobile' => $faker->phoneNumber,
                                    'email_verified_at' => Carbon::now(),
                                    'password' => bcrypt('123123123'),
                                    'status' => 1,
                                    ]);

            $user->attachRole($userRole);

        }

    }
}
