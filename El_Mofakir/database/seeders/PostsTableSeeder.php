<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Issue;
use App\Models\Post;
use App\Models\User;
use App\Models\Volume;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $volumes = Volume::toBase()->get();
        $categories = Category::all()->modelKeys();
        $users = User::where('id', '>', 2)->get()->modelKeys();
        $posts = [];

        $posts =[
            [
                'title' => 'الوساطة كآلية لحل النزاعات الدولية المعاصرة - دراسة حالة الوساطة الجزائرية في ليبيا',
                'title_en' => 'Mediation as a Mechanism for Resolving Contemporary International Conflicts - A Case Study of Algerian Mediation in Libya',
                'slug' => 'الوساطة-كآلية-لحل-النزاعات-الدولية-المعاصرة-دراسة-حالة-الوساطة-الجزائرية-في-ليبيا',
                'slug_en' => 'mediation-as-a-mechanism-for-resolving-contemporary-international-conflicts-a-case-study-of-algerian-mediation-in-libya',
                'description' => 'تهدف هذه الدراسة إلى إبراز الدور الذي تلعبه الجزائر كدولة محورية في التسوية السلمية للأزمة الليبية، حيث تم تسليط الضوء على دور الوساطة الجزائرية في ليبيا والتي ارتكزت على البعد السياسي والبعد الأمني. وخلصت هذه الدراسة إلى نتيجة مفادها أن جهود الوساطة الجزائرية واجهت العديد من التحديات أبرزها: حالة الانقسام المؤسساتي التي تطبع الساحة السياسية الليبية، الانقسام الذي ينخر المجتمع الليبي وكذا استعصاء مد جسور الحوار في بيئة تهيمن عليها الميلشيات المسلحة والجماعات الإرهابية وجماعات الجريمة المنظمة، هذه الأخيرة لا تستقر على هوية محددة كما أنها لا تتمتع بالشرعية في البلاد وهذا في ما يتعلق بالمستوى المحلي، أما على المستوى الدولي، فتفضل بعض القوى الخارجية الإبقاء على الوضع القائم في ليبيا بدل تحقيق الاستقرار بالإضافة إلى عدم نضج النزاع للحل، مما يعرقل من جهود التسوية السلمية للأزمة الليبية.',
                'description_en' => ' This article aims to highlight the role played by Algeria as a key-state in the peaceful resolution of the Libyan crisis, with a focus on the role of the Algerian mediation that was centered on the political and security dimensions. This study concludes that Algerian mediation efforts faced several challenges. On the domestic level, it is obstructed by institutional and social divisions that characterize the Libyan socio-political scene along with the difficulty in initiating dialogue within an unstable environment that is controlled by armed militias, terrorist groups, and organized crime groups that lack legitimacy and a fixed identity. On the international level, some foreign forces prefer to maintain the status quo in Libya .rather than achieving stability. In Addition, the Libyan conflict is not yet “ripe” for resolution which undermines all efforts to exit this deadlock',
                'status' => 1,
                'user_id' => 5,
                'category_id' => 4,
                'volume_id' => 5,
                'issue_id' => 1,
                'created_at' => "2024-06-30 01:01:01",
                'updated_at' => "2024-06-30 01:01:01",
            ],
            [
                'title' => 'دور الجامعة في تنمية قيم المواطنة لدى الأساتذة - دراسة ميدانية لعينة من أساتذة معهد علوم وتقنيات النشاطات البدنية والرياضية ورقلة',
                'title_en' => 'Role of the University in Developing Citizenship Values Among Professors - A Field Study of a Sample of Professors from the Institute of Physical and Sports Activities Sciences and Techniques, Ouargla',
                'slug' => 'دور-الجامعة-في-تنمية-قيم-المواطنة-لدى-الأساتذة-دراسة-ميدانية-لعينة-من-أساتذة-معهد-علوم-وتقنيات-النشاطات-البدنية-والرياضية-ورقلة',
                'slug_en' => 'role-of-the-university-in-developing-citizenship-values-among-professors-a-field-study-of-a-sample-of-professors-from-the-institute-of-physical-and-sports-activities-sciences-and-techniques-ouargla',
                'description' => 'هدفت الدراسة الحالية التعرف على دور الجامعة في تنمية قيم المواطنة لدى الأساتذة و الفروق في استجابة العينة تعزى لمتغير الرتبة. و اعتمد الباحث على المنهج الوصفي والاستبيان كأداة للدراسة وتمثلت العينة في 20 أستاذا بمعهد علوم وتقنيات النشاطات البدنية والرياضية (ورقلة) وقد أظهرت النتائج أن دور الجامعة في تنمية قيم المواطنة لدى الأساتذة يتميز بدرجة عالية و وجود فروق ذات دلالة إحصائية في استجابة العينة تعزى لمتغير الرتبة لصالح أستاذ التعليم العالي. وخلصت الدراسة إلى مجموعة من الاقتراحات. كلمات مفتاحية: الجامعة، قيم المواطنة، الأستاذ الجامعي، الرتبة.',
                'description_en' => "The current study aimed to identify the role of the university in developing citizenship values among professors and the differences in the sample's responses attributed to the rank variable. The researcher relied on the descriptive method and the questionnaire as a study tool. The sample consisted of 20 professors at the Institute of Physical and Sports Activities Sciences and Techniques (Ouargla). The results showed that the university's role in developing citizenship values among professors is highly significant, and there are statistically significant differences in the sample's responses attributed to the rank variable in favor of higher education professors. The study concluded with a set of suggestions. Keywords: university, citizenship values, university professor, rank.",
                'status' => 1,
                'user_id' => 5,
                'category_id' => 2,
                'volume_id' => 5,
                'issue_id' => 1,
                'created_at' => '2024-06-30 01:01:01',
                'updated_at' => '2024-06-30 01:01:01',
            ],
            [
                'title' => 'العقد الإداري لاستثمار الأملاك الوقفية في التشريع الجزائري.',
                'title_en' => 'The Administrative Contract for Investing Endowment Properties in Algerian Legislation.',
                'slug' => 'العقد-الإداري-لاستثمار-الأملاك-الوقفية-في-التشريع-الجزائري',
                'slug_en' => 'the-administrative-contract-for-investing-endowment-properties-in-algerian-legislation',
                'description' => 'يعتبر موضوع استثمار الأملاك الوقفية بواسطة العقد الإداري للاستثمار بمثابة محاولة تشريعية تستهدف تطوير قطاع الأوقاف في الجزائر، من خلال تفعيل مصلحة المؤسسة الوقفية والسير بها نحو ما يعرف بالاقتصاد الوقفي المنتج؛ وذلك من خلال فتح المجال لانجاز مشاريع استثمارية عن طريق استغلال الملك الوقفي كوعاء عقاري قادر على استيعاب حجم المشروع، وبذلك يكون العقد الإداري قد ساهم في الحد من الركود الذي أصاب وضعية الأوقاف طيلة المدة التي سبقت سن المرسوم التنفيذي 18-213 الذي يحدد شروط وكيفيات استغلال العقارات الوقفية الموجهة لانجاز مشاريع استثمارية والتي عرفت فراغا تنظيميا فيما يتعلق بالاستثمار، فيكون هذا العقد بمثابة محرر ومحرك للأعيان الوقفية نحو اقتصاد وقفي أمثل.',
                'description_en' => 'The issue of investing endowment properties through the administrative investment contract is considered as a legislative attempt aimed at developing the endowment sector in Algeria, By activating the interest of the endowment institution and moving it towards what is known as the productive endowment economy, by opening the way for the completion of investment projects by exploiting the endowment property as a real estate container capable of accommodating the size of the project, Thus, the administrative contract has contributed to reducing the stagnation that affected the status of endowments throughout the period preceding the enactment of Executive Decree 18-213, which defines the conditions and modalities for the exploitation of endowment real estate destined for the completion of investment projects, which has known a regulatory vacuum with regard to investment, so that this contract serves as a liberator and engine for endowment objects towards an optimal endowment economy.',
                'status' => 1,
                'user_id' => 5,
                'category_id' => 1,
                'volume_id' => 5,
                'issue_id' => 1,
                'created_at' => '2024-06-30 01:01:01',
                'updated_at' => '2024-06-30 01:01:01',
            ],
            [
                'title' => 'تأثير النزاع الاثني على مسار التنمية في جمهورية الكونغو الديموقراطية',
                'title_en' => 'The Impact of Ethnic Conflict on the Development Path in the Democratic Republic of the Congo',
                'slug' => 'تأثير-النزاع-الاثني-على-مسار-التنمية-في-جمهورية-الكونغو-الديموقراطية',
                'slug_en' => 'the-impact-of-ethnic-conflict-on-the-development-path-in-the-democratic-republic-of-the-congo',
                'description' => 'تعالج هذه الدراسة ظاهرة النزاعات الاثنية في القارة الإفريقية لما لها من تأثير مباشر على عدم قدرة هذه الأخيرة من وضع خطواتها الأولى في مسار التطور وتحقيق التنمية، حيث برز التوتر المستمر بين المجموعات الاثنية سواء داخل الدولة الواحدة، أو بين مجموعة من الدول بعد الحرب الباردة كنوع جديد من النزاعات ألا وهي النزاعات الداخلية. وقد خلصت هذه الدراسة إلى أنّ النزاع الدائم بين الجماعات الاثنية الذي تعاني منه اغلب الدول الإفريقية ونخض بالذكر جمهوريّة الكونغو الديموقراطية كان له تداعيات سلبيّة كبيرة تعد السبب الرئيس وراء مظاهر التخلف وانعدام الأمن وبالتالي صعوبة تحقيق مظاهر التنمية فيها.',
                'description_en' => 'This study deals with the phenomenon of ethnic conflicts in the African continent because of its direct impact on the inability of the latter to take its first steps in the path of development and development, as the constant tension emerged between ethnic groups, whether within a single country, or between a group of countries after the Cold War as a kind New conflicts, namely internal conflicts. This study concluded that the permanent conflict between ethnic groups that most African countries suffer from, and we mention the Democratic Republic of the Congo, had great negative repercussions, which are the main reason behind the manifestations of underdevelopment and insecurity, and thus the difficulty of achieving development aspects in it.',
                'status' => 1,
                'user_id' => 5,
                'category_id' => 3,
                'volume_id' => 5,
                'issue_id' => 1,
                'created_at' => '2024-06-30 01:01:01',
                'updated_at' => '2024-06-30 01:01:01',
            ],
            [
                'title' => 'مكانة تركيا في السياسة الخارجية الروسية بين التنافس والتكافؤ',
                'title_en' => 'Turkey\'s Position in Russian Foreign Policy Between Competition and Equivalence',
                'slug' => 'مكانة-تركيا-في-السياسة-الخارجية-الروسية-بين-التنافس-والتكافؤ',
                'slug_en' => 'turkeys-position-in-russian-foreign-policy-between-competition-and-equivalence',
                'description' => 'فرضت براغماتية السياسة الخارجية الروسية نمطا متجددا ومرنا لتحركات هذه الأخيرة على الساحة الدولية وفي بيئتها الإقليمية. فسعي القيادة السياسية في روسيا لاستعادة مكانتها كقوة كبرى دفعها إلى إعادة النظر في علاقاتها مع دول الجوار، وفي هذا السياق تعد تركيا بدورها الفاعل في بيئتها الإقليمية توجها مهما لتفعيل الدور الروسي في الساحة الدولية. لذلك ستساعدنا هذه الدراسة على تحديد وفهم مرتكزات المكانة الجيوبوليتكية التي تحتلها تركيا في السياسة الخارجية الروسية وكذا مجالات التعاون الاقتصادي بينهما، كما تتيح لنا تفسير التقارب والتعاون العسكري بين الدولتين.',
                'description_en' => "The pragmatic of Russian foreign policy imposed a new and flexible pattern of its movements in the international and regional arena. Russia's political leadership seek to restore their status as a major power pushed it to consider its relations with neighboring countries; in this context, Turkey is a key element to activate Russian role in the international arena, Hence this study is going to help us to identify and understand the basics of the geopolitical position which Turkey occupied in Russian's foreign policy: as well as, areas of economic cooperation between them, and this study gives us the opportunity to explain the motives behind this military rapprochement and cooperation between the two countries.",
                'status' => 1,
                'user_id' => 5,
                'category_id' => 1,
                'volume_id' => 5,
                'issue_id' => 1,
                'created_at' => '2024-06-30 01:01:01',
                'updated_at' => '2024-06-30 01:01:01',
            ],
        ];

        foreach ($volumes as $volume) {
            $volumeIssues = Issue::where('volume_id', $volume->id)->get();
            foreach ($volumeIssues as $issue) {
                for ($i = 0; $i < 10; $i++) {
                    $post_title = $faker->sentence(mt_rand(3, 6), true);
                    $post_title_en = $faker->sentence(mt_rand(3, 6), true);

                    $slug = Str::slug($post_title);
                    $slug_en = Str::slug($post_title_en);

                    // Ensure unique slugs
                    $original_slug = $slug;
                    $original_slug_en = $slug_en;
                    $counter = 1;

                    while (Post::where('slug', $slug)->exists()) {
                        $slug = $original_slug . '-' . $counter++;
                    }

                    $counter = 1;
                    while (Post::where('slug_en', $slug_en)->exists()) {
                        $slug_en = $original_slug_en . '-' . $counter++;
                    }

                    $posts[] = [
                        'title' => $post_title,
                        'title_en' => $post_title_en,
                        'slug' => $slug,
                        'slug_en' => $slug_en,
                        'description' => $faker->paragraph(),
                        'description_en' => $faker->paragraph(),
                        'status' => rand(0, 1),
                        'user_id' => Arr::random($users),
                        'category_id' => Arr::random($categories),
                        'volume_id' => $volume->id,
                        'issue_id' => $issue->id,
                        'created_at' => $issue->issue_date . " 01:01:01",
                        'updated_at' => $issue->issue_date . " 01:01:01",
                    ];
                }
            }
        }

        $chunks = array_chunk($posts, 1000);
        foreach ($chunks as $chunk) {
            Post::insert($chunk);
        }

//        Post::insert($posts);

    }
}
