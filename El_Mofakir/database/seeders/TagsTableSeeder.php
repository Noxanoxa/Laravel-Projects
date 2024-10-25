<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create(['name' => 'المكانة', 'name_en' => 'Status']);
        Tag::create(['name' => 'تركيا', 'name_en' => 'Turkey']);
        Tag::create(['name' => 'السياسة الروسية', 'name_en' => 'Russian Politics']);
        Tag::create(['name' => 'الأزمة الليبية', 'name_en' => 'Libyan Crisis']);
        Tag::create(['name' => 'الدبلوماسية الجزائرية', 'name_en' => 'Algerian Diplomacy']);
        Tag::create(['name' => 'الوساطة الدولية', 'name_en' => 'International Mediation']);
        Tag::create(['name' => 'كلمات مفتاحية: الجامعة، قيم المواطنة، الأستاذ الجامعي، الرتبة', 'name_en' => 'Keywords: University, Citizenship Values, University Professor, Rank']);
        Tag::create(['name' => 'الاستثمار الوقفي', 'name_en' => 'Endowment Investment']);
        Tag::create(['name' => 'العقد الإداري للاستثمار', 'name_en' => 'Administrative Investment Contract']);
        Tag::create(['name' => 'الاستثمار العقاري', 'name_en' => 'Real Estate Investment']);
        Tag::create(['name' => 'الأملاك الوقفية', 'name_en' => 'Endowment Properties']);
    }
}
