<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('permissions')->truncate();

        // MAIN
        $manageMain              = Permission::create(
            [
                'name'            => 'main',
                'display_name'    => 'الرئيسية',
                'description'     => 'الرئيسية',
                'display_name_en' => 'Main',
                'description_en'  => 'Administrator Dashboard',
                'route'           => 'index',
                'module'          => 'index',
                'as'              => 'index',
                'icon'            => 'fa fa-home',
                'parent'          => '0',
                'parent_original' => '0',
                'sidebar_link'    => '1',
                'appear'          => '1',
                'ordering'        => '1',
            ]
        );
        $manageMain->parent_show = $manageMain->id;
        $manageMain->save();

        // POSTS
        $managePosts              = Permission::create(
            [
                'name'            => 'manage_posts',
                'display_name'    => 'المقالات',
                'description'     => 'إدارة المقالات',
                'display_name_en' => 'Posts',
                'description_en'  => 'Manage Posts',
                'route'           => 'posts',
                'module'          => 'posts',
                'as'              => 'posts.index',
                'icon'            => 'fas fa-newspaper',
                'parent'          => '0',
                'parent_original' => '0',
                'appear'          => '1',
                'ordering'        => '5',
            ]
        );
        $managePosts->parent_show = $managePosts->id;
        $managePosts->save();
        $showPosts    = Permission::create(
            [
                'name'            => 'show_posts',
                'display_name'    => 'عرض المقالات',
                'description'     => 'عرض المقالات',
                'display_name_en' => 'Show Posts',
                'description_en'  => 'Show Posts',
                'route'           => 'posts',
                'module'          => 'posts',
                'as'              => 'posts.index',
                'icon'            => 'fas fa-newspaper',
                'parent'          => $managePosts->id,
                'parent_show'     => $managePosts->id,
                'parent_original' => $managePosts->id,
                'appear'          => '1',
                'ordering'        => '0',
            ]
        );
        $createPosts  = Permission::create(
            [
                'name'            => 'create_posts',
                'display_name'    => 'إنشاء مقال',
                'description'     => 'إنشاء مقال جديدة',
                'display_name_en' => 'Create Post',
                'description_en'  => 'Create a new post',
                'route'           => 'posts/create',
                'module'          => 'posts',
                'as'              => 'posts.create',
                'icon'            => null,
                'parent'          => $managePosts->id,
                'parent_show'     => $managePosts->id,
                'parent_original' => $managePosts->id,
                'appear'          => '0',
                'ordering'        => '0',
            ]
        );
        $displayPost  = Permission::create(
            [
                'name'            => 'display_posts',
                'display_name'    => 'عرض المقال',
                'description'     => 'عرض تفاصيل المقال',
                'display_name_en' => 'Show Post',
                'description_en'  => 'Show post details',
                'route'           => 'posts/{posts}',
                'module'          => 'posts',
                'as'              => 'posts.show',
                'icon'            => null,
                'parent'          => $managePosts->id,
                'parent_show'     => $managePosts->id,
                'parent_original' => $managePosts->id,
                'appear'          => '0',
                'ordering'        => '0',
            ]
        );
        $updatePosts  = Permission::create(
            [
                'name'            => 'update_posts',
                'display_name'    => 'تعديل المقال',
                'description'     => 'تحديث تفاصيل المقال',
                'display_name_en' => 'Update Post',
                'description_en'  => 'Update post details',
                'route'           => 'posts/{posts}/edit',
                'module'          => 'posts',
                'as'              => 'posts.edit',
                'icon'            => null,
                'parent'          => $managePosts->id,
                'parent_show'     => $managePosts->id,
                'parent_original' => $managePosts->id,
                'appear'          => '0',
                'ordering'        => '0',
            ]
        );
        $destroyPosts = Permission::create(
            [
                'name'            => 'delete_posts',
                'display_name'    => 'حذف المقال',
                'description'     => 'حذف المقال',
                'display_name_en' => 'Delete Post',
                'description_en'  => 'Delete post',
                'route'           => 'posts/{posts}',
                'module'          => 'posts',
                'as'              => 'posts.delete',
                'icon'            => null,
                'parent'          => $managePosts->id,
                'parent_show'     => $managePosts->id,
                'parent_original' => $managePosts->id,
                'appear'          => '0',
                'ordering'        => '0',
            ]
        );

        // announcements

        $manageAnnouncements              = Permission::create(
            [
                'name'            => 'manage_announcements',
                'display_name'    => 'الإعلانات',
                'description'     => 'إدارة الإعلانات',
                'display_name_en' => 'Announcements',
                'description_en'  => 'Manage Announcements',
                'route'           => 'announcements',
                'module'          => 'announcements',
                'as'              => 'announcements.index',
                'icon'            => 'fas fa-bullhorn',
                'parent'          => '0',
                'parent_original' => '0',
                'appear'          => '1',
                'ordering'        => '6',
            ]
        );
        $manageAnnouncements->parent_show = $manageAnnouncements->id;
        $manageAnnouncements->save();
        $showAnnouncements    = Permission::create(
            [
                'name'            => 'show_announcements',
                'display_name'    => 'عرض الإعلانات',
                'description'     => 'عرض الإعلانات',
                'display_name_en' => 'Show Announcements',
                'description_en'  => 'Show Announcements',
                'route'           => 'announcements',
                'module'          => 'announcements',
                'as'              => 'announcements.index',
                'icon'            => 'fas fa-bullhorn',
                'parent'          => $manageAnnouncements->id,
                'parent_show'     => $manageAnnouncements->id,
                'parent_original' => $manageAnnouncements->id,
                'appear'          => '1',
                'ordering'        => '0',
            ]
        );
        $createAnnouncements  = Permission::create(
            [
                'name'            => 'create_announcements',
                'display_name'    => 'إنشاء إعلان',
                'description'     => 'إنشاء إعلان جديدة',
                'display_name_en' => 'Create Announcement',
                'description_en'  => 'Create a new announcement',
                'route'           => 'announcements/create',
                'module'          => 'announcements',
                'as'              => 'announcements.create',
                'icon'            => null,
                'parent'          => $manageAnnouncements->id,
                'parent_show'     => $manageAnnouncements->id,
                'parent_original' => $manageAnnouncements->id,
                'appear'          => '0',
                'ordering'        => '0',
            ]
        );
        $displayAnnouncement  = Permission::create(
            [
                'name'            => 'display_announcements',
                'display_name'    => 'عرض الإعلان',
                'description'     => 'عرض تفاصيل الإعلان',
                'display_name_en' => 'Show Announcement',
                'description_en'  => 'Show announcement details',
                'route'           => 'announcements/{announcements}',
                'module'          => 'announcements',
                'as'              => 'announcements.show',
                'icon'            => null,
                'parent'          => $manageAnnouncements->id,
                'parent_show'     => $manageAnnouncements->id,
                'parent_original' => $manageAnnouncements->id,
                'appear'          => '0',
                'ordering'        => '0',
            ]
        );
        $updateAnnouncements  = Permission::create(
            [
                'name'            => 'update_announcements',
                'display_name'    => 'تعديل الإعلان',
                'description'     => 'تحديث تفاصيل الإعلان',
                'display_name_en' => 'Update Announcement',
                'description_en'  => 'Update announcement details',
                'route'           => 'announcements/{announcements}/edit',
                'module'          => 'announcements',
                'as'              => 'announcements.edit',
                'icon'            => null,
                'parent'          => $manageAnnouncements->id,
                'parent_show'     => $manageAnnouncements->id,
                'parent_original' => $manageAnnouncements->id,
                'appear'          => '0',
                'ordering'        => '0',
            ]
        );
        $destroyAnnouncements = Permission::create(
            [
                'name'            => 'delete_announcements',
                'display_name'    => 'حذف الإعلان',
                'description'     => 'حذف الإعلان',
                'display_name_en' => 'Delete Announcement',
                'description_en'  => 'Delete announcement',
                'route'           => 'announcements/{announcements}',
                'module'          => 'announcements',
                'as'              => 'announcements.delete',
                'icon'            => null,
                'parent'          => $manageAnnouncements->id,
                'parent_show'     => $manageAnnouncements->id,
                'parent_original' => $manageAnnouncements->id,
                'appear'          => '0',
                'ordering'        => '0',
            ]
        );

        // POSTS CATEGORIES
        $managePostCategories              = Permission::create(
            [
                'name'            => 'manage_post_categories',
                'display_name'    => ' الأقسام',
                'description'     => 'إدارة  الأقسام',
                'display_name_en' => 'Categories',
                'description_en'  => 'Manage Categories',
                'route'           => 'post_categories',
                'module'          => 'post_categories',
                'as'              => 'post_categories.index',
                'icon'            => 'fas fa-file-archive',
                'parent'          => $managePosts->id,
                'parent_original' => '0',
                'appear'          => '0',
                'ordering'        => '15',
            ]
        );
        $managePostCategories->parent_show = $managePostCategories->id;
        $managePostCategories->save();
        $showPostCategories    = Permission::create(
            [
                'name'            => 'show_post_categories',
                'display_name'    => 'عرض  الأقسام',
                'description'     => 'عرض  الأقسام',
                'display_name_en' => 'Show Categories',
                'description_en'  => 'Show Categories',
                'route'           => 'post_categories',
                'module'          => 'post_categories',
                'as'              => 'post_categories.index',
                'icon'            => 'fas fa-file-archive',
                'parent'          => $managePosts->id,
                'parent_show'     => $managePostCategories->id,
                'parent_original' => $managePostCategories->id,
                'appear'          => '1',
                'ordering'        => '0',
            ]
        );
        $createPostCategories  = Permission::create(
            [
                'name'            => 'create_post_categories',
                'display_name'    => 'إنشاء  قسم',
                'description'     => 'إنشاء  قسم جديدة',
                'display_name_en' => 'Create Category',
                'description_en'  => 'Create a new category',
                'route'           => 'post_categories/create',
                'module'          => 'post_categories',
                'as'              => 'post_categories.create',
                'icon'            => null,
                'parent'          => $managePosts->id,
                'parent_show'     => $managePostCategories->id,
                'parent_original' => $managePostCategories->id,
                'appear'          => '0',
                'ordering'        => '0',
            ]
        );
        $updatePostCategories  = Permission::create(
            [
                'name'            => 'update_post_categories',
                'display_name'    => 'تحديث القسم',
                'description'     => 'تحديث تفاصيل القسم',
                'display_name_en' => 'Update Category',
                'description_en'  => 'Update category details',
                'route'           => 'post_categories/{post_categories}/edit',
                'module'          => 'post_categories',
                'as'              => 'post_categories.edit',
                'icon'            => null,
                'parent'          => $managePosts->id,
                'parent_show'     => $managePostCategories->id,
                'parent_original' => $managePostCategories->id,
                'appear'          => '0',
                'ordering'        => '0',
            ]
        );
        $destroyPostCategories = Permission::create(
            [
                'name'            => 'delete_post_categories',
                'display_name'    => 'حذف القسم',
                'description'     => 'حذف القسم',
                'display_name_en' => 'Delete Category',
                'description_en'  => 'Delete category',
                'route'           => 'post_categories/{post_categories}',
                'module'          => 'post_categories',
                'as'              => 'post_categories.delete',
                'icon'            => null,
                'parent'          => $managePosts->id,
                'parent_show'     => $managePostCategories->id,
                'parent_original' => $managePostCategories->id,
                'appear'          => '0',
                'ordering'        => '0',
            ]
        );

        //  VOLUMES
        $manageVolumes              = Permission::create(
            [
                'name'            => 'manage_volumes',
                'display_name'    => 'الأعداد',
                'description'     => 'إدارة الأعداد',
                'display_name_en' => 'Volumes',
                'description_en'  => 'Manage Volumes',
                'route'           => 'volumes',
                'module'          => 'volumes',
                'as'              => 'volumes.index',
                'icon'            => 'fas fa-book',
                'parent'          => '0',
                'parent_original' => '0',
                'appear'          => '1',
                'ordering'        => '10',
            ]
        );
        $manageVolumes->parent_show = $manageVolumes->id;
        $manageVolumes->save();
        $showVolumes    = Permission::create(
            [
                'name'            => 'show_volumes',
                'display_name'    => 'عرض الأعداد',
                'description'     => 'عرض الأعداد',
                'display_name_en' => 'Show Volumes',
                'description_en'  => 'Show Volumes',
                'route'           => 'volumes',
                'module'          => 'volumes',
                'as'              => 'volumes.index',
                'icon'            => 'fas fa-book',
                'parent'          => $manageVolumes->id,
                'parent_show'     => $manageVolumes->id,
                'parent_original' => $manageVolumes->id,
                'appear'          => '1',
                'ordering'        => '0',
            ]
        );
        $createVolumes  = Permission::create(
            [
                'name'            => 'create_volumes',
                'display_name'    => 'إنشاء عدد',
                'description'     => 'إنشاء عدد جديدة',
                'display_name_en' => 'Create Volume',
                'description_en'  => 'Create a new volume',
                'route'           => 'volumes/create',
                'module'          => 'volumes',
                'as'              => 'volumes.create',
                'icon'            => null,
                'parent'          => $manageVolumes->id,
                'parent_show'     => $manageVolumes->id,
                'parent_original' => $manageVolumes->id,
                'appear'          => '0',
                'ordering'        => '0',
            ]
        );
        $displayVolumes = Permission::create(
            [
                'name'            => 'display_volumes',
                'display_name'    => 'عرض العدد',
                'description'     => 'عرض تفاصيل العدد',
                'display_name_en' => 'Show Volume',
                'description_en'  => 'Show Volume',
                'route'           => 'volumes/{volumes}',
                'module'          => 'volumes',
                'as'              => 'volumes.show',
                'icon'            => null,
                'parent'          => $manageVolumes->id,
                'parent_show'     => $manageVolumes->id,
                'parent_original' => $manageVolumes->id,
                'appear'          => '0',
                'ordering'        => '0',
            ]
        );
        $updateVolumes  = Permission::create(
            [
                'name'            => 'update_volumes',
                'display_name'    => 'تحديث العدد',
                'description'     => 'تحديث تفاصيل العدد',
                'display_name_en' => 'Update Volume',
                'description_en'  => 'Update volume details',
                'route'           => 'volumes/{volumes}/edit',
                'module'          => 'volumes',
                'as'              => 'volumes.edit',
                'icon'            => null,
                'parent'          => $manageVolumes->id,
                'parent_show'     => $manageVolumes->id,
                'parent_original' => $manageVolumes->id,
                'appear'          => '0',
                'ordering'        => '0',
            ]
        );
        $destroyVolumes = Permission::create(
            [
                'name'            => 'delete_volumes',
                'display_name'    => 'حذف العدد',
                'description'     => 'حذف العدد',
                'display_name_en' => 'Delete Volume',
                'description_en'  => 'Delete volume',
                'route'           => 'volumes/{volumes}',
                'module'          => 'volumes',
                'as'              => 'volumes.delete',
                'icon'            => null,
                'parent'          => $manageVolumes->id,
                'parent_show'     => $manageVolumes->id,
                'parent_original' => $manageVolumes->id,
                'appear'          => '0',
                'ordering'        => '0',
            ]
        );

        // ISSUES Numbers that is subchild from Volumes
        $manageIssues              = Permission::create(
            [
                'name'            => 'manage_issues',
                'display_name'    => 'الارقام',
                'description'     => 'إدارة الارقام',
                'display_name_en' => 'Issues',
                'description_en'  => 'Manage Issues',
                'route'           => 'issues',
                'module'          => 'issues',
                'as'              => 'issues.index',
                'icon'            => 'fas fa-book',
                'parent'          => $manageVolumes->id,
                'parent_original' => '0',
                'appear'          => '0',
                'ordering'        => '15',
            ]
        );
        $manageIssues->parent_show = $manageIssues->id;
        $manageIssues->save();
        $showIssues    = Permission::create(
            [
                'name'            => 'show_issues',
                'display_name'    => 'عرض الارقام',
                'description'     => 'عرض الارقام',
                'display_name_en' => 'Show Issues',
                'description_en'  => 'Show Issues',
                'route'           => 'issues',
                'module'          => 'issues',
                'as'              => 'issues.index',
                'icon'            => 'fas fa-book',
                'parent'          => $manageVolumes->id,
                'parent_show'     => $manageIssues->id,
                'parent_original' => $manageIssues->id,
                'appear'          => '1',
                'ordering'        => '0',
            ]
        );
        $createIssues  = Permission::create(
            [
                'name'            => 'create_issues',
                'display_name'    => 'إنشاء رقم',
                'description'     => 'إنشاء رقم جديدة',
                'display_name_en' => 'Create Issue',
                'description_en'  => 'Create a new issue',
                'route'           => 'issues/create',
                'module'          => 'issues',
                'as'              => 'issues.create',
                'icon'            => null,
                'parent'          => $manageVolumes->id,
                'parent_show'     => $manageIssues->id,
                'parent_original' => $manageIssues->id,
                'appear'          => '0',
                'ordering'        => '0',
            ]
        );
        $displayIssues = Permission::create(
            [
                'name'            => 'display_issues',
                'display_name'    => 'عرض الرقم',
                'description'     => 'عرض تفاصيل الرقم',
                'display_name_en' => 'Show Issue',
                'description_en'  => 'Show Issue',
                'route'           => 'issues/{issues}',
                'module'          => 'issues',
                'as'              => 'issues.show',
                'icon'            => null,
                'parent'          => $manageVolumes->id,
                'parent_show'     => $manageIssues->id,
                'parent_original' => $manageIssues->id,
                'appear'          => '0',
                'ordering'        => '0',
            ]
        );
        $updateIssues  = Permission::create(
            [
                'name'            => 'update_issues',
                'display_name'    => 'تحديث الرقم',
                'description'     => 'تحديث تفاصيل الرقم',
                'display_name_en' => 'Update Issue',
                'description_en'  => 'Update issue details',
                'route'           => 'issues/{issues}/edit',
                'module'          => 'issues',
                'as'              => 'issues.edit',
                'icon'            => null,
                'parent'          => $manageVolumes->id,
                'parent_show'     => $manageIssues->id,
                'parent_original' => $manageIssues->id,
                'appear'          => '0',
                'ordering'        => '0',
            ]
        );
        $destroyIssues = Permission::create(
            [
                'name'            => 'delete_issues',
                'display_name'    => 'حذف الرقم',
                'description'     => 'حذف الرقم',
                'display_name_en' => 'Delete Issue',
                'description_en'  => 'Delete issue',
                'route'           => 'issues/{issues}',
                'module'          => 'issues',
                'as'              => 'issues.delete',
                'icon'            => null,
                'parent'          => $manageVolumes->id,
                'parent_show'     => $manageIssues->id,
                'parent_original' => $manageIssues->id,
                'appear'          => '0',
                'ordering'        => '0',
            ]
        );

        // POSTS TAGS
        $managePostTags              = Permission::create(
            [
                'name'            => 'manage_post_tags',
                'display_name'    => 'الكلمات المفتاحية',
                'description'     => 'إدارة الكلمات المفتاحية',
                'display_name_en' => 'Tags',
                'description_en'  => 'Manage Tags',
                'route'           => 'post_tags',
                'module'          => 'post_tags',
                'as'              => 'post_tags.index',
                'icon'            => 'fas fa-tags',
                'parent'          => $managePosts->id,
                'parent_original' => '0',
                'appear'          => '0',
                'ordering'        => '16',
            ]
        );
        $managePostTags->parent_show = $managePostTags->id;
        $managePostTags->save();
        $showPostTags    = Permission::create(
            [
                'name'            => 'show_post_tags',
                'display_name'    => 'عرض الكلمات المفتاحية',
                'description'     => 'عرض الكلمات المفتاحية',
                'display_name_en' => 'Show Tags',
                'description_en'  => 'Show Tags',
                'route'           => 'post_tags',
                'module'          => 'post_tags',
                'as'              => 'post_tags.index',
                'icon'            => 'fas fa-tags',
                'parent'          => $managePosts->id,
                'parent_show'     => $managePostTags->id,
                'parent_original' => $managePostTags->id,
                'appear'          => '1',
                'ordering'        => '0',
            ]
        );
        $createPostTags  = Permission::create(
            [
                'name'            => 'create_post_tags',
                'display_name'    => 'إنشاء كلمة مفتاحية',
                'description'     => 'إنشاء كلمة مفتاحية جديدة',
                'display_name_en' => 'Create Tag',
                'description_en'  => 'Create a new tag',
                'route'           => 'post_tags/create',
                'module'          => 'post_tags',
                'as'              => 'post_tags.create',
                'icon'            => null,
                'parent'          => $managePosts->id,
                'parent_show'     => $managePostTags->id,
                'parent_original' => $managePostTags->id,
                'appear'          => '0',
                'ordering'        => '0',
            ]
        );
        $updatePostTags  = Permission::create(
            [
                'name'            => 'update_post_tags',
                'display_name'    => 'تحديث الكلمة المفتاحية',
                'description'     => 'تحديث تفاصيل الكلمة المفتاحية',
                'display_name_en' => 'Update Tag',
                'description_en'  => 'Update tag details',
                'route'           => 'post_tags/{post_tags}/edit',
                'module'          => 'post_tags',
                'as'              => 'post_tags.edit',
                'icon'            => null,
                'parent'          => $managePosts->id,
                'parent_show'     => $managePostTags->id,
                'parent_original' => $managePostTags->id,
                'appear'          => '0',
                'ordering'        => '0',
            ]
        );
        $destroyPostTags = Permission::create(
            [
                'name'            => 'delete_post_tags',
                'display_name'    => 'حذف الكلمة المفتاحية',
                'description'     => 'حذف الكلمة المفتاحية',
                'display_name_en' => 'Delete Tag',
                'description_en'  => 'Delete tag',
                'route'           => 'post_tags/{post_tags}',
                'module'          => 'post_tags',
                'as'              => 'post_tags.delete',
                'icon'            => null,
                'parent'          => $managePosts->id,
                'parent_show'     => $managePostTags->id,
                'parent_original' => $managePostTags->id,
                'appear'          => '0',
                'ordering'        => '0',
            ]
        );

        // PAGES
        $managePages              = Permission::create([
            'name'            => 'manage_pages',
            'display_name'    => 'الصفحات',
            'description'     => 'إدارة الصفحات',
            'display_name_en' => 'Pages',
            'description_en'  => 'Manage Pages',
            'route'           => 'pages',
            'module'          => 'pages',
            'as'              => 'pages.index',
            'icon'            => 'fas fa-file',
            'parent'          => '0',
            'parent_original' => '0',
            'appear'          => '1',
            'ordering'        => '20',
        ]);
        $managePages->parent_show = $managePages->id;
        $managePages->save();

        $showPages = Permission::create([
            'name'            => 'show_pages',
            'display_name'    => 'عرض الصفحات',
            'description'     => 'عرض الصفحات',
            'display_name_en' => 'Show Pages',
            'description_en'  => 'Show Pages',
            'route'           => 'pages',
            'module'          => 'pages',
            'as'              => 'pages.index',
            'icon'            => 'fas fa-file',
            'parent'          => $managePages->id,
            'parent_show'     => $managePages->id,
            'parent_original' => $managePages->id,
            'appear'          => '1',
            'ordering'        => '0',
        ]);

        $createPages = Permission::create([
            'name'            => 'create_pages',
            'display_name'    => 'إنشاء صفحة',
            'description'     => 'إنشاء صفحة جديدة',
            'display_name_en' => 'Create Page',
            'description_en'  => 'Create a new page',
            'route'           => 'pages/create',
            'module'          => 'pages',
            'as'              => 'pages.create',
            'icon'            => null,
            'parent'          => $managePages->id,
            'parent_show'     => $managePages->id,
            'parent_original' => $managePages->id,
            'appear'          => '0',
            'ordering'        => '0',
        ]);

        $displayPages = Permission::create([
            'name'            => 'display_pages',
            'display_name'    => 'عرض الصفحة',
            'description'     => 'عرض الصفحة',
            'display_name_en' => 'Show Page',
            'description_en'  => 'Show Page',
            'route'           => 'pages/{pages}',
            'module'          => 'pages',
            'as'              => 'pages.show',
            'icon'            => null,
            'parent'          => $managePages->id,
            'parent_show'     => $managePages->id,
            'parent_original' => $managePages->id,
            'appear'          => '0',
            'ordering'        => '0',
        ]);

        $updatePages = Permission::create([
            'name'            => 'update_pages',
            'display_name'    => 'تحديث الصفحة',
            'description'     => 'تحديث تفاصيل الصفحة',
            'display_name_en' => 'Update Page',
            'description_en'  => 'Update page details',
            'route'           => 'pages/{pages}/edit',
            'module'          => 'pages',
            'as'              => 'pages.edit',
            'icon'            => null,
            'parent'          => $managePages->id,
            'parent_show'     => $managePages->id,
            'parent_original' => $managePages->id,
            'appear'          => '0',
            'ordering'        => '0',
        ]);

        $destroyPages = Permission::create([
            'name'            => 'delete_pages',
            'display_name'    => 'حذف الصفحة',
            'description'     => 'حذف الصفحة',
            'display_name_en' => 'Delete Page',
            'description_en'  => 'Delete Page',
            'route'           => 'pages/{pages}',
            'module'          => 'pages',
            'as'              => 'pages.delete',
            'icon'            => null,
            'parent'          => $managePages->id,
            'parent_show'     => $managePages->id,
            'parent_original' => $managePages->id,
            'appear'          => '0',
            'ordering'        => '0',
        ]);

        // Contact Us
        $manageContactUs              = Permission::create([
            'name'            => 'manage_contact_us',
            'display_name'    => 'اتصل بنا',
            'description'     => 'إدارة اتصل بنا',
            'display_name_en' => 'Contact Us',
            'description_en'  => 'Manage Contact Us',
            'route'           => 'contact_us',
            'module'          => 'contact_us',
            'as'              => 'contact_us.index',
            'icon'            => 'fas fa-envelope',
            'parent'          => '0',
            'parent_original' => '0',
            'appear'          => '1',
            'ordering'        => '20',
        ]);
        $manageContactUs->parent_show = $manageContactUs->id;
        $manageContactUs->save();

        $showContactUs = Permission::create([
            'name'            => 'show_contact_us',
            'display_name'    => 'عرض اتصل بنا',
            'description'     => 'عرض اتصل بنا',
            'display_name_en' => 'Show Contact Us',
            'description_en'  => 'Show Contact Us',
            'route'           => 'contact_us',
            'module'          => 'contact_us',
            'as'              => 'contact_us.index',
            'icon'            => 'fas fa-envelope',
            'parent'          => $manageContactUs->id,
            'parent_show'     => $manageContactUs->id,
            'parent_original' => $manageContactUs->id,
            'appear'          => '1',
            'ordering'        => '0',
        ]);

        $displayContactUs = Permission::create([
            'name'            => 'display_contact_us',
            'display_name'    => 'عرض الرسالة',
            'description'     => 'عرض الرسالة',
            'display_name_en' => 'Display Message',
            'description_en'  => 'Display Message',
            'route'           => 'contact_us/{contact_us}',
            'module'          => 'contact_us',
            'as'              => 'contact_us.show',
            'icon'            => null,
            'parent'          => $manageContactUs->id,
            'parent_show'     => $manageContactUs->id,
            'parent_original' => $manageContactUs->id,
            'appear'          => '0',
            'ordering'        => '0',
        ]);

        $updateContactUs = Permission::create([
            'name'            => 'update_contact_us',
            'display_name'    => 'تحديث الرسالة',
            'description'     => 'تحديث تفاصيل الرسالة',
            'display_name_en' => 'Update Message',
            'description_en'  => 'Update Message details',
            'route'           => 'contact_us/{contact_us}/edit',
            'module'          => 'contact_us',
            'as'              => 'contact_us.edit',
            'icon'            => null,
            'parent'          => $manageContactUs->id,
            'parent_show'     => $manageContactUs->id,
            'parent_original' => $manageContactUs->id,
            'appear'          => '0',
            'ordering'        => '0',
        ]);

        $destroyContactUs = Permission::create([
            'name'            => 'delete_contact_us',
            'display_name'    => 'حذف الرسالة',
            'description'     => 'حذف الرسالة',
            'display_name_en' => 'Delete Message',
            'description_en'  => 'Delete Message',
            'route'           => 'contact_us/{contact_us}',
            'module'          => 'contact_us',
            'as'              => 'contact_us.delete',
            'icon'            => null,
            'parent'          => $manageContactUs->id,
            'parent_show'     => $manageContactUs->id,
            'parent_original' => $manageContactUs->id,
            'appear'          => '0',
            'ordering'        => '0',
        ]);

        // USERS
        $manageUsers              = Permission::create([
            'name'            => 'manage_users',
            'display_name'    => 'إدارة المؤلفين',
            'description'     => 'إدارة المؤلفين',
            'display_name_en' => 'Authors',
            'description_en'  => 'Manage Authors',
            'route'           => 'users',
            'module'          => 'users',
            'as'              => 'users.index',
            'icon'            => 'fas fa-user',
            'parent'          => '0',
            'parent_original' => '0',
            'appear'          => '1',
            'ordering'        => '20',
        ]);
        $manageUsers->parent_show = $manageUsers->id;
        $manageUsers->save();

        $showAuthors = Permission::create([
            'name'            => 'show_users',
            'display_name'    => 'المؤلفين',
            'description'     => 'عرض المؤلفين',
            'display_name_en' => 'Authors',
            'description_en'  => 'Show Authors',
            'route'           => 'users',
            'module'          => 'users',
            'as'              => 'users.index',
            'icon'            => 'fas fa-user',
            'parent'          => $manageUsers->id,
            'parent_show'     => $manageUsers->id,
            'parent_original' => $manageUsers->id,
            'appear'          => '1',
            'ordering'        => '0',
        ]);

        $createUsers = Permission::create([
            'name'            => 'create_users',
            'display_name'    => 'إنشاء مستخدم',
            'description'     => 'إنشاء مستخدم جديد',
            'display_name_en' => 'Create Author',
            'description_en'  => 'Create Author',
            'route'           => 'users/create',
            'module'          => 'users',
            'as'              => 'users.create',
            'icon'            => null,
            'parent'          => $manageUsers->id,
            'parent_show'     => $manageUsers->id,
            'parent_original' => $manageUsers->id,
            'appear'          => '0',
            'ordering'        => '0',
        ]);

        $displayUsers = Permission::create([
            'name'            => 'display_users',
            'display_name'    => 'عرض المستخدم',
            'description'     => 'عرض تفاصيل المستخدم',
            'display_name_en' => 'Show Author',
            'description_en'  => 'Show Author',
            'route'           => 'users/{users}',
            'module'          => 'users',
            'as'              => 'users.show',
            'icon'            => null,
            'parent'          => $manageUsers->id,
            'parent_show'     => $manageUsers->id,
            'parent_original' => $manageUsers->id,
            'appear'          => '0',
            'ordering'        => '0',
        ]);

        $updateUsers = Permission::create([
            'name'            => 'update_users',
            'display_name'    => 'تحديث المستخدم',
            'description'     => 'تحديث بيانات المستخدم',
            'display_name_en' => 'Update Author',
            'description_en'  => 'Update Author',
            'route'           => 'users/{users}/edit',
            'module'          => 'users',
            'as'              => 'users.edit',
            'icon'            => null,
            'parent'          => $manageUsers->id,
            'parent_show'     => $manageUsers->id,
            'parent_original' => $manageUsers->id,
            'appear'          => '0',
            'ordering'        => '0',
        ]);

        $destroyUsers = Permission::create([
            'name'            => 'delete_users',
            'display_name'    => 'حذف المستخدم',
            'description'     => 'حذف المستخدم',
            'display_name_en' => 'Delete Author',
            'description_en'  => 'Delete Author',
            'route'           => 'users/{users}',
            'module'          => 'users',
            'as'              => 'users.delete',
            'icon'            => null,
            'parent'          => $manageUsers->id,
            'parent_show'     => $manageUsers->id,
            'parent_original' => $manageUsers->id,
            'appear'          => '0',
            'ordering'        => '0',
        ]);

        // PROFESSIONALS
        $manageProfessionals = Permission::create([
            'name'            => 'manage_professionals',
            'display_name'    => 'المحترفين',
            'description'     => 'إدارة المحترفين',
            'display_name_en' => 'Professionals',
            'description_en'  => 'Manage Professionals',
            'route'           => 'professionals',
            'module'          => 'professionals',
            'as'              => 'professionals.index',
            'icon'            => 'fas fa-user-tie',
            'parent'          => $manageUsers->id,
            'parent_original' => '0',
            'appear'          => '1',
            'ordering'        => '30',
        ]);
        $manageProfessionals->parent_show = $manageProfessionals->id;
        $manageProfessionals->save();

        $showProfessionals = Permission::create([
            'name'            => 'show_professionals',
            'display_name'    => 'عرض المحترفين',
            'description'     => 'عرض المحترفين',
            'display_name_en' => 'Show Professionals',
            'description_en'  => 'Show Professionals',
            'route'           => 'professionals',
            'module'          => 'professionals',
            'as'              => 'professionals.index',
            'icon'            => 'fas fa-user-tie',
            'parent'          => $manageProfessionals->id,
            'parent_show'     => $manageProfessionals->id,
            'parent_original' => $manageProfessionals->id,
            'appear'          => '1',
            'ordering'        => '0',
        ]);

        // SETTINGS
        $manageSettings              = Permission::create([
            'name'            => 'manage_settings',
            'display_name'    => 'الإعدادات',
            'description'     => 'إدارة الإعدادات',
            'display_name_en' => 'Settings',
            'description_en'  => 'Manage Settings',
            'route'           => 'settings',
            'module'          => 'settings',
            'as'              => 'settings.index',
            'icon'            => 'fas fa-cog',
            'parent'          => '0',
            'parent_original' => '0',
            'appear'          => '0',
            'ordering'        => '600',
            'sidebar_link'    => '0',
        ]);
        $manageSettings->parent_show = $manageSettings->id;
        $manageSettings->save();

        $showSettings = Permission::create([
            'name'            => 'show_settings',
            'display_name'    => 'الإعدادات',
            'description'     => 'عرض الإعدادات',
            'display_name_en' => 'Settings',
            'description_en'  => 'Show Settings',
            'route'           => 'settings',
            'module'          => 'settings',
            'as'              => 'settings.index',
            'icon'            => 'fas fa-cog',
            'parent'          => $manageSettings->id,
            'parent_show'     => $manageSettings->id,
            'parent_original' => $manageSettings->id,
            'appear'          => '1',
            'ordering'        => '0',
            'sidebar_link'    => '0',
        ]);

        $createSettings = Permission::create([
            'name'            => 'create_settings',
            'display_name'    => 'إنشاء إعدادات',
            'description'     => 'إنشاء إعدادات جديدة',
            'display_name_en' => 'Create Settings',
            'description_en'  => 'Create Settings',
            'route'           => 'settings/create',
            'module'          => 'settings',
            'as'              => 'settings.create',
            'icon'            => null,
            'parent'          => $manageSettings->id,
            'parent_show'     => $manageSettings->id,
            'parent_original' => $manageSettings->id,
            'appear'          => '0',
            'ordering'        => '0',
            'sidebar_link'    => '0',
        ]);

        $displaySettings = Permission::create([
            'name'            => 'display_settings',
            'display_name'    => 'عرض الإعدادات',
            'description'     => 'عرض تفاصيل الإعدادات',
            'display_name_en' => 'Show Settings',
            'description_en'  => 'Show Settings',
            'route'           => 'settings/{settings}',
            'module'          => 'settings',
            'as'              => 'settings.show',
            'icon'            => null,
            'parent'          => $manageSettings->id,
            'parent_show'     => $manageSettings->id,
            'parent_original' => $manageSettings->id,
            'appear'          => '0',
            'ordering'        => '0',
            'sidebar_link'    => '0',
        ]);

        $updateSettings = Permission::create([
            'name'            => 'update_settings',
            'display_name'    => 'تحديث الإعدادات',
            'description'     => 'تحديث بيانات الإعدادات',
            'display_name_en' => 'Update Settings',
            'description_en'  => 'Update Settings',
            'route'           => 'settings/{settings}/edit',
            'module'          => 'settings',
            'as'              => 'settings.edit',
            'icon'            => null,
            'parent'          => $manageSettings->id,
            'parent_show'     => $manageSettings->id,
            'parent_original' => $manageSettings->id,
            'appear'          => '0',
            'ordering'        => '0',
            'sidebar_link'    => '0',
        ]);

        $destroySettings = Permission::create([
            'name'            => 'delete_settings',
            'display_name'    => 'حذف الإعدادات',
            'description'     => 'حذف الإعدادات',
            'display_name_en' => 'Delete Settings',
            'description_en'  => 'Delete Settings',
            'route'           => 'settings/{settings}',
            'module'          => 'settings',
            'as'              => 'settings.delete',
            'icon'            => null,
            'parent'          => $manageSettings->id,
            'parent_show'     => $manageSettings->id,
            'parent_original' => $manageSettings->id,
            'appear'          => '0',
            'ordering'        => '0',
            'sidebar_link'    => '0',
        ]);
    }

}
