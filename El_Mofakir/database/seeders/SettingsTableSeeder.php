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

        Setting::create([ 'display_name' =>  '(English) عنوان الموقع','display_name_en' => 'Site title (English)', 'key' => 'site_title', 'value' => 'EL Mofakir', 'type' => 'text', 'section' => 'عام', 'section_en' => 'general','lang' => 'en', 'ordering' => 1]);
        Setting::create([  'display_name' => '(English) شعار الموقع','display_name_en' => 'Site Slogan (English)', 'key' => 'site_slogan', 'value' => 'Amazing blog', 'details' => null, 'type' => 'text', 'section' => 'عام', 'section_en' => 'general','lang' => 'en', 'ordering' => 2]);
        Setting::create([  'display_name' => '(English) وصف الموقع','display_name_en' => 'Site Description (English)', 'key' => 'site_description', 'value' => 'El Mofakir Content management system', 'details' => null, 'type' => 'text', 'section' => 'عام', 'section_en' => 'general','lang' => 'en', 'ordering' => 3]);
        Setting::create([  'display_name' => '(English) الكلمات المفتاحية','display_name_en' => 'Site Keywords (English)', 'key' => 'site_keywords', 'value' => 'El Mofakir, blog, multi writer', 'details' => null, 'type' => 'text', 'section' => 'عام', 'section_en' => 'general','lang' => 'en', 'ordering' => 4]);
        Setting::create([  'display_name' => '(English) ايميل الموقع','display_name_en' => 'Site Email (English)', 'key' => 'site_email', 'value' => 'admin@elmofakir.test', 'details' => null, 'type' => 'text', 'section' => 'عام', 'section_en' => 'general','lang' => 'en', 'ordering' => 5]);
        Setting::create([  'display_name' => '(English) حالة الموقع','display_name_en' => 'Site Status (English)', 'key' => 'site_status', 'value' => 'Active', 'details' => null, 'type' => 'text', 'section' => 'عام', 'section_en' => 'general','lang' => 'en', 'ordering' => 6]);
        Setting::create([  'display_name' => '(English) اسم الاداري','display_name_en' => 'Admin Title (English)', 'key' => 'admin_title', 'value' => 'El Mofakir', 'details' => null, 'type' => 'text', 'section' => 'عام', 'section_en' => 'general','lang' => 'en', 'ordering' => 7]);
        Setting::create([  'display_name' => '(English) رقم الهاتف','display_name_en' => 'Phone Number (English)', 'key' => 'phone_number', 'value' => '033501228', 'details' => null, 'type' => 'text', 'section' => 'عام', 'section_en' => 'general','lang' => 'en', 'ordering' => 8]);
        Setting::create([  'display_name' => '(English) العنوان', 'display_name_en' => 'Address (English)', 'key' => 'address', 'value' => 'University of Biskra - P.O. Box 145 Q.R.-07000 - Biskra Algeria', 'details' => null, 'type' => 'text', 'section' => 'عام', 'section_en' => 'general','lang' => 'en', 'ordering' => 9]);
        Setting::create([ 'display_name' => 'Facebook معرف (English)',  'display_name_en' => 'Facebook ID (English)', 'key' => 'facebook_id', 'value' => 'https://www.facebook.com/fdsbiskra', 'details' => null, 'type' => 'text', 'section' => 'مواقع التواصل الاجتماعي', 'section_en' => 'social_accounts','lang' => 'en', 'ordering' => 4]);
        Setting::create([ 'display_name' => 'Google Map API Key',  'display_name_en' => 'Google Map API Key', 'key' => 'google_map_api_key', 'value' => 'https://maps.app.goo.gl/CFmsP5WHb1tnH3kb9', 'details' => null, 'type' => 'text', 'section' => 'عام', 'section_en' => 'general','lang' => 'en', 'ordering' => 12]);
        Setting::create([ 'display_name' => 'Website of the university',  'display_name_en' => 'Website of the university', 'key' => 'website_univ', 'value' => 'https://fdsp.univ-biskra.dz/', 'details' => null, 'type' => 'text', 'section' => 'مواقع التواصل الاجتماعي', 'section_en' => 'social_accounts','lang' => 'en', 'ordering' => 13]);

        Setting::create([ 'display_name' =>  '(عربي) عنوان الموقع','display_name_en' => 'Site title (عربي)', 'key' => 'site_title', 'value' => 'مجلة المفكر', 'type' => 'text', 'section' => 'عام', 'section_en' => 'general','lang' => 'ar', 'ordering' => 1]);
        Setting::create([  'display_name' => '(عربي) شعار الموقع','display_name_en' => 'Site Slogan (عربي)', 'key' => 'site_slogan', 'value' => 'Amazing blog', 'details' => null, 'type' => 'text', 'section' => 'عام', 'section_en' => 'general','lang' => 'ar', 'ordering' => 2]);
        Setting::create([  'display_name' => '(عربي) وصف الموقع','display_name_en' => 'Site Description (عربي)', 'key' => 'site_description', 'value' => 'El Mofakir Content management system', 'details' => null, 'type' => 'text', 'section' => 'عام', 'section_en' => 'general','lang' => 'ar', 'ordering' => 3]);
        Setting::create([  'display_name' => '(عربي) الكلمات المفتاحية','display_name_en' => 'Site Keywords (عربي)', 'key' => 'site_keywords', 'value' => 'El Mofakir, blog, multi writer', 'details' => null, 'type' => 'text', 'section' => 'عام', 'section_en' => 'general','lang' => 'ar', 'ordering' => 4]);
        Setting::create([  'display_name' => '(عربي) ايميل الموقع','display_name_en' => 'Site Email (عربي)', 'key' => 'site_email', 'value' => 'admin@elmofakir.test', 'details' => null, 'type' => 'text', 'section' => 'عام', 'section_en' => 'general','lang' => 'ar', 'ordering' => 5]);
        Setting::create([  'display_name' => '(عربي) حالة الموقع','display_name_en' => 'Site Status (عربي)', 'key' => 'site_status', 'value' => 'Active', 'details' => null, 'type' => 'text', 'section' => 'عام', 'section_en' => 'general','lang' => 'ar', 'ordering' => 6]);
        Setting::create([  'display_name' => '(عربي) اسم الاداري','display_name_en' => 'Admin Title (عربي)', 'key' => 'admin_title', 'value' => 'El Mofakir', 'details' => null, 'type' => 'text', 'section' => 'عام', 'section_en' => 'general','lang' => 'ar', 'ordering' => 7]);
        Setting::create([  'display_name' => '(عربي) رقم الهاتف','display_name_en' => 'Phone Number (عربي)', 'key' => 'phone_number', 'value' => '033501228', 'details' => null, 'type' => 'text', 'section' => 'عام', 'section_en' => 'general','lang' => 'ar', 'ordering' => 8]);
        Setting::create([  'display_name' => '(عربي) العنوان', 'display_name_en' => 'Address (عربي)', 'key' => 'address', 'value' => 'University of Biskra - P.O. Box 145 Q.R.-07000 - Biskra Algeria', 'details' => null, 'type' => 'text', 'section' => 'عام', 'section_en' => 'general','lang' => 'ar', 'ordering' => 9]);
        Setting::create([ 'display_name' => 'Google Map API Key',  'display_name_en' => 'Google Map API Key', 'key' => 'google_map_api_key', 'value' => 'https://maps.app.goo.gl/CFmsP5WHb1tnH3kb9', 'details' => null, 'type' => 'text', 'section' => 'عام', 'section_en' => 'general','lang' => 'ar', 'ordering' => 12]);
        Setting::create([ 'display_name' => 'Website of the university',  'display_name_en' => 'Website of the university', 'key' => 'website_univ', 'value' => 'https://fdsp.univ-biskra.dz/', 'details' => null, 'type' => 'text', 'section' => 'مواقع التواصل الاجتماعي', 'section_en' => 'social_accounts','lang' => 'ar', 'ordering' => 13]);
        Setting::create([ 'display_name' => 'Facebook معرف (عربي)',  'display_name_en' => 'Facebook ID (عربي)', 'key' => 'facebook_id', 'value' => 'https://www.facebook.com/fdsbiskra', 'details' => null, 'type' => 'text', 'section' => 'مواقع التواصل الاجتماعي', 'section_en' => 'social_accounts','lang' => 'ar', 'ordering' => 4]);

    }
}
