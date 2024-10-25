<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\Page;


class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

         Page::create([
            'title' => 'نبذة عنا',
            'title_en' => 'About Us',
            'description' => '"المفكر" هي مجلة محكمة دولية تصدر نصف سنويًا (يونيو-ديسمبر) من قبل كلية الحقوق والعلوم السياسية بجامعة محمد خيضر بسكرة-الجزائر. تتخصص في مجال القانون والعلوم السياسية، مثل القانون العام والخاص بجميع فروعه، العلوم السياسية بجميع فروعها، وكذلك الشريعة والقانون، والإدارة العامة. تهدف المجلة بشكل رئيسي إلى النشر المجاني - ورقيًا وإلكترونيًا - للأعمال الأصلية، والدراسات، والأبحاث المتجددة باللغات الثلاث: العربية والإنجليزية، لمختلف الأساتذة والباحثين حول العالم، بهدف المساهمة في إثراء المعرفة العلمية وتطوير الدراسات المتخصصة في المجالات المذكورة أعلاه.',
            'description_en' => ' "El-Mofaker" is an international refereed review published semi-annually (June-December) by the Faculty of Law and Political Science-University of Mohammad Khider Biskra-Algeria. It specializes in the field of law and political science, such as public and private law in all its branches, political science in all Its branches, as well as Sharia and law, and public administration. The review aims mainly to free publication - on paper and electronically - of original works, studies and renewable research in the three languages: Arabic and English, for various professors and researchers around the world, aiming to contribute to Enriching scientific knowledge and developing specialized studies in the above-mentioned fields.',
            'status' => 1,
            'post_type' => 'page',
            'user_id' => 1,
            'category_id' => 1,
        ]);

    }

}
