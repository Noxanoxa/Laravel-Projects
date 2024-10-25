<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;

class  RoleTableSeeder extends Seeder
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
            'name'            => 'admin',
            'display_name'    => 'الادارة',
            'display_name_en' => 'Adminstrator',
            'description'     => 'مدير النظام',
            'description_en'  => 'System Adminstrator',
            'allowed_route'   => 'admin',
        ]);

        $userRole = Role::create([
            'name'            => 'user',
            'display_name'    => 'مستخدم',
            'display_name_en' => 'User',
            'description'     => 'مستخدم عادي',
            'description_en'  => 'Normal User',
            'allowed_route'   => null,
        ]);

        $admin = User::create([
            'name'              => 'Admin',
            'username'          => 'admin',
            'email'             => 'admin@elmofakir.test',
            'mobile'            => '0771015417',
            'password'          => bcrypt('123123123'),
            'status'            => 1,
        ]);

        $admin->attachRole($adminRole);

        $admin = User::create([
            'name'     => 'Admin2',
            'username' => 'admin2',
            'email'    => 'admin2@elmofakir.test',
            'mobile'   => '0771015413',
            'password' => bcrypt('123123123'),
            'status'   => 1,
        ]);

        $admin->attachRole($adminRole);

        $user1 = User::create(
            [
                'name'              => 'samer amri',
                'username'          => 'Sameramri54',
                'email'             => 'amrisamer54@elmofakir.test',
                'mobile'            => '0771015418',

                'password'          => bcrypt('123123123'),
                'status'            => 1,
            ]
        );
        $user1->attachRole($userRole);
        $user2 = User::create(
            [
                'name'              => 'hana ben said',
                'username'          => 'hayoo07',
                'email'             => 'hanaben07@elmofakir.test',
                'mobile'            => '0771015443',
                'password'          => bcrypt('123123123'),
                'status'            => 1,
            ]
        );
        $user2->attachRole($userRole);
        $user3 = User::create(
            [
                'name'              => 'onax xano',
                'username'          => 'onax55',
                'email'             => 'onax@elmofakir.test',
                'mobile'            => '0771015432',
                'password'          => bcrypt('123123123'),
                'status'            => 1,
            ]
        );
        $user3->attachRole($userRole);

        for ($i = 0; $i < 10; $i++) {
            $user = User::create([
                'name'              => $faker->name,
                'username'          => $faker->userName,
                'email'             => $faker->email,
                //                                  'mobile' => '956' . random_int(100000, 999999),
                'mobile'            => '07' . $faker->numerify('########'),
                'password'          => bcrypt('123123123'),
                'status'            => 1,
            ]);

            $user->attachRole($userRole);
        }
    }

}
