<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(RoleTableSeeder::class);
         $this->call(PermissionTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(VolumesTableSeeder::class);
        $this->call(IssuesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(PostsTagsTableSeeder::class);
        $this->call(AnnouncementsTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(PagesTableSeeder::class);


    }
}
