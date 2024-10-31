<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::truncate();

        Setting::create(
            [
                'display_name'    => 'عنوان الموقع',
                'display_name_en' => 'Site title',
                'key'             => 'site_title',
                'value'           => 'مجلة المفكر',
                'value_en'        => 'EL Mofakir',
                'type'            => 'text',
                'section'         => 'عام',
                'section_en'      => 'general',
                'ordering' => 1,
            ]
        );
        Setting::create(
            [
                'display_name'    => 'شعار الموقع',
                'display_name_en' => 'Site Slogan',
                'key'             => 'site_slogan',
                'value'           => 'مدونة مذهلة',
                'value_en'        => 'Amazing blog',
                'details'         => null,
                'type'            => 'text',
                'section'         => 'عام',
                'section_en'      => 'general',
                'ordering' => 2,
            ]
        );
        Setting::create(
            [
                'display_name'    => 'وصف الموقع',
                'display_name_en' => 'Site Description',
                'key'             => 'site_description',
                'value_en'           => 'El Mofakir Content management system',
                'value'           => 'نظام إدارة المحتوى المفكر',
                'details'         => null,
                'type'            => 'text',
                'section'         => 'عام',
                'section_en'      => 'general',

                'ordering' => 3,
            ]
        );
        Setting::create(
            [
                'display_name'    => 'الكلمات المفتاحية',
                'display_name_en' => 'Site Keywords',
                'key'             => 'site_keywords',
                'value_en'           => 'El Mofakir, blog, multi writer',
                'value'           => 'المفكر, مدونة, متعدد الكتاب',
                'details'         => null,
                'type'            => 'text',
                'section'         => 'عام',
                'section_en'      => 'general',

                'ordering' => 4,
            ]
        );
        Setting::create(
            [
                'display_name'    => 'ايميل الموقع',
                'display_name_en' => 'Site Email',
                'key'             => 'site_email',
                'value'           => 'admin@elmofakir.test',
                'details'         => null,
                'type'            => 'text',
                'section'         => 'عام',
                'section_en'      => 'general',

                'ordering' => 5,
            ]
        );
        Setting::create(
            [
                'display_name'    => 'رقم الهاتف',
                'display_name_en' => 'Phone Number',
                'key'             => 'phone_number',
                'value'           => '033501228',
                'details'         => null,
                'type'            => 'text',
                'section'         => 'عام',
                'section_en'      => 'general',

                'ordering' => 8,
            ]
        );
        Setting::create(
            [
                'display_name'    => 'العنوان',
                'display_name_en' => 'Address',
                'key'             => 'address',
                'value'           => 'University of Biskra - P.O. Box 145 Q.R.-07000 - Biskra Algeria',
                'details'         => null,
                'type'            => 'text',
                'section'         => 'عام',
                'section_en'      => 'general',

                'ordering' => 9,
            ]
        );
        Setting::create(
            [
                'display_name'    => 'Facebook معرف',
                'display_name_en' => 'Facebook ID',
                'key'             => 'facebook_id',
                'value'           => 'https://www.facebook.com/fdsbiskra',
                'details'         => null,
                'type'            => 'text',
                'section'         => 'مواقع التواصل الاجتماعي',
                'section_en'      => 'social_accounts',

                'ordering' => 4,
            ]
        );
        Setting::create(
            [
                'display_name'    => 'Google Map API Key',
                'display_name_en' => 'Google Map API Key',
                'key'             => 'google_map_api_key',
                'value'           => 'https://maps.app.goo.gl/CFmsP5WHb1tnH3kb9',
                'details'         => null,
                'type'            => 'text',
                'section'         => 'عام',
                'section_en'      => 'general',

                'ordering' => 12,
            ]
        );
        Setting::create(
            [
                'display_name'    => 'Website of the university',
                'display_name_en' => 'Website of the university',
                'key'             => 'website_univ',
                'value'           => 'https://fdsp.univ-biskra.dz/',
                'details'         => null,
                'type'            => 'text',
                'section'         => 'مواقع التواصل الاجتماعي',
                'section_en'      => 'social_accounts',

                'ordering' => 13,
            ]
        );

        Setting::create(
            [
                'display_name'    => 'EISSN',
                'display_name_en' => 'EISSN',
                'key'             => 'eissn',
                'value'           => '2600-6081',
                'type'            => 'text',
                'section'         => 'احصائيات المجلة',
                'section_en'      => 'journal_info',

                'ordering' => 1,
            ]
        );
        Setting::create(
            [
                'display_name'    => 'التردد',
                'display_name_en' => 'Frequency',
                'key'             => 'frequency',
                'value'           => 'نصف سنوي',
                'value_en'        => 'Semestrial',
                'type'            => 'text',
                'section'         => 'احصائيات المجلة',
                'section_en'      => 'journal_info',

                'ordering' => 2,
            ]
        );
        Setting::create(
            [
                'display_name'    => 'معدل القبول',
                'display_name_en' => 'Acceptance Rate',
                'key'             => 'acceptance_rate',
                'value'           => '91%',
                'value_en'        => '91%',
                'type'            => 'text',
                'section'         => 'احصائيات المجلة',
                'section_en'      => 'journal_info',

                'ordering' => 3,
            ]
        );
        Setting::create(
            [
                'display_name'    => 'متوسط وقت الاستجابة',
                'display_name_en' => 'Average Response Time',
                'key'             => 'average_response_time',
                'value'           => '290',
                'value_en'        => '290',
                'type'            => 'text',
                'section'         => 'احصائيات المجلة',
                'section_en'      => 'journal_info',

                'ordering' => 4,
            ]
        );
        Setting::create(
            [
                'display_name'    => 'وقت النشر بعد القبول',
                'display_name_en' => 'Publication Time After Acceptance',
                'key'             => 'publication_time',
                'value'           => '66',
                'value_en'        => '66',
                'type'            => 'text',
                'section'         => 'احصائيات المجلة',
                'section_en'      => 'journal_info',

                'ordering' => 5,
            ]
        );
        Setting::create(
            [
                'display_name'    => 'سنة الإنشاء',
                'display_name_en' => 'Year of Creation',
                'key'             => 'year_of_creation',
                'value'           => '2006',
                'value_en'        => '2006',
                'type'            => 'text',
                'section'         => 'احصائيات المجلة',
                'section_en'      => 'journal_info',
                'ordering' => 6,
            ]
        );

        Setting::create(
            [
                'display_name'    => 'اسم المؤسسة',
                'display_name_en' => 'Institution Name',
                'key'             => 'institution_name',
                'value'           => 'جامعة محمد خيضر بسكرة',
                'value_en'        => 'University of Mohamed Khider Biskra',
                'type'            => 'text',
                'section'         => 'احصائيات المجلة',
                'section_en'      => 'journal_info',
                'ordering' => 7,
            ]
        );

        Setting::create(
            [
                'display_name'    => 'معامل التأثير',
                'display_name_en' => 'Impact Factor',
                'key'             => 'impact_factor',
                'value'           => '0.6455',
                'value_en'        => '0.6455',
                'type'            => 'text',
                'section'         => 'احصائيات المجلة',
                'section_en'      => 'journal_info',
                'ordering' => 8,
            ]
        );
        // country
        Setting::create(
            [
                'display_name'    => 'البلد',
                'display_name_en' => 'Country',
                'key'             => 'country',
                'value'           => 'الجزائر',
                'value_en'        => 'Algeria',
                'type'            => 'text',
                'section'         => 'احصائيات المجلة',
                'section_en'      => 'journal_info',
                'ordering' => 9,
            ]
        );
    }

}
