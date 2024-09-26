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
        $manageMain = Permission::create(['name' => 'main', 'display_name' => 'الرئيسية', 'description' => 'الرئيسية','display_name_en' => 'Main', 'description_en' => 'Administrator Dashboard', 'route' => 'index', 'module' => 'index', 'as' => 'index', 'icon' => 'fa fa-home', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '1',]);
        $manageMain->parent_show = $manageMain->id; $manageMain->save();

     /*   // POSTS
        $managePosts = Permission::create([ 'name' => 'manage_posts', 'display_name' => 'Posts', 'route' => 'posts', 'module' => 'posts', 'as' => 'posts.index', 'icon' => 'fas fa-newspaper', 'parent' => '0', 'parent_original' => '0', 'appear' => '1', 'ordering' => '5', ]);
        $managePosts->parent_show = $managePosts->id; $managePosts->save();
        $showPosts = Permission::create([ 'name' => 'show_posts', 'display_name' => 'Posts', 'route' => 'posts', 'module' => 'posts', 'as' => 'posts.index', 'icon' => 'fas fa-newspaper', 'parent' => $managePosts->id, 'parent_show' => $managePosts->id, 'parent_original' => $managePosts->id, 'appear' => '1', 'ordering' => '0', ]);
        $createPosts = Permission::create([ 'name' => 'create_posts', 'display_name' => 'Create Post', 'route' => 'posts/create', 'module' => 'posts', 'as' => 'posts.create', 'icon' => null, 'parent' => $managePosts->id, 'parent_show' => $managePosts->id, 'parent_original' => $managePosts->id, 'appear' => '0', 'ordering' => '0',]);
        $displayPost = Permission::create([ 'name' => 'display_posts', 'display_name' => 'Show Post', 'route' => 'posts/{posts}', 'module' => 'posts', 'as' => 'posts.show', 'icon' => null, 'parent' => $managePosts->id, 'parent_show' => $managePosts->id, 'parent_original' => $managePosts->id, 'appear' => '0', 'ordering' => '0', ]);
        $updatePosts = Permission::create([ 'name' => 'update_posts', 'display_name' => 'Update Post', 'route' => 'posts/{posts}/edit', 'module' => 'posts', 'as' => 'posts.edit', 'icon' => null, 'parent' => $managePosts->id, 'parent_show' => $managePosts->id, 'parent_original' => $managePosts->id, 'appear' => '0', 'ordering' => '0', ]);
         $destroyPosts = Permission::create([ 'name' => 'delete_posts', 'display_name' => 'Delete Post', 'route' => 'posts/{posts}', 'module' => 'posts', 'as' => 'posts.delete', 'icon' => null, 'parent' => $managePosts->id, 'parent_show' => $managePosts->id, 'parent_original' => $managePosts->id, 'appear' => '0', 'ordering' => '0', ]);*/

        // POSTS
        $managePosts = Permission::create(['name' => 'manage_posts', 'display_name' => 'المقالات', 'description' => 'إدارة المقالات', 'display_name_en' => 'Posts', 'description_en' => 'Manage Posts', 'route' => 'posts', 'module' => 'posts', 'as' => 'posts.index', 'icon' => 'fas fa-newspaper', 'parent' => '0', 'parent_original' => '0', 'appear' => '1', 'ordering' => '5',]);
        $managePosts->parent_show = $managePosts->id;$managePosts->save();
        $showPosts = Permission::create(['name' => 'show_posts', 'display_name' => 'عرض المقالات', 'description' => 'عرض المقالات', 'display_name_en' => 'Show Posts', 'description_en' => 'Show Posts', 'route' => 'posts', 'module' => 'posts', 'as' => 'posts.index', 'icon' => 'fas fa-newspaper', 'parent' => $managePosts->id, 'parent_show' => $managePosts->id, 'parent_original' => $managePosts->id, 'appear' => '1', 'ordering' => '0',]);
        $createPosts = Permission::create(['name' => 'create_posts', 'display_name' => 'إنشاء مقال', 'description' => 'إنشاء مقال جديدة', 'display_name_en' => 'Create Post', 'description_en' => 'Create a new post', 'route' => 'posts/create', 'module' => 'posts', 'as' => 'posts.create', 'icon' => null, 'parent' => $managePosts->id, 'parent_show' => $managePosts->id, 'parent_original' => $managePosts->id, 'appear' => '0', 'ordering' => '0',]);
        $displayPost = Permission::create(['name' => 'display_posts', 'display_name' => 'عرض المقال', 'description' => 'عرض تفاصيل المقال', 'display_name_en' => 'Show Post', 'description_en' => 'Show post details', 'route' => 'posts/{posts}', 'module' => 'posts', 'as' => 'posts.show', 'icon' => null, 'parent' => $managePosts->id, 'parent_show' => $managePosts->id, 'parent_original' => $managePosts->id, 'appear' => '0', 'ordering' => '0',]);
        $updatePosts = Permission::create(['name' => 'update_posts', 'display_name' => 'تعديل المقال', 'description' => 'تحديث تفاصيل المقال', 'display_name_en' => 'Update Post', 'description_en' => 'Update post details', 'route' => 'posts/{posts}/edit', 'module' => 'posts', 'as' => 'posts.edit', 'icon' => null, 'parent' => $managePosts->id, 'parent_show' => $managePosts->id, 'parent_original' => $managePosts->id, 'appear' => '0', 'ordering' => '0',]);
        $destroyPosts = Permission::create(['name' => 'delete_posts', 'display_name' => 'حذف المقال', 'description' => 'حذف المقال', 'display_name_en' => 'Delete Post', 'description_en' => 'Delete post', 'route' => 'posts/{posts}', 'module' => 'posts', 'as' => 'posts.delete', 'icon' => null, 'parent' => $managePosts->id, 'parent_show' => $managePosts->id, 'parent_original' => $managePosts->id, 'appear' => '0', 'ordering' => '0',]);


        // announcements

        $manageAnnouncements = Permission::create(['name' => 'manage_announcements', 'display_name' => 'الإعلانات', 'description' => 'إدارة الإعلانات', 'display_name_en' => 'Announcements', 'description_en' => 'Manage Announcements', 'route' => 'announcements', 'module' => 'announcements', 'as' => 'announcements.index', 'icon' => 'fas fa-bullhorn', 'parent' => '0', 'parent_original' => '0', 'appear' => '1', 'ordering' => '6',]);
        $manageAnnouncements->parent_show = $manageAnnouncements->id;$manageAnnouncements->save();
        $showAnnouncements = Permission::create(['name' => 'show_announcements', 'display_name' => 'عرض الإعلانات', 'description' => 'عرض الإعلانات', 'display_name_en' => 'Show Announcements', 'description_en' => 'Show Announcements', 'route' => 'announcements', 'module' => 'announcements', 'as' => 'announcements.index', 'icon' => 'fas fa-bullhorn', 'parent' => $manageAnnouncements->id, 'parent_show' => $manageAnnouncements->id, 'parent_original' => $manageAnnouncements->id, 'appear' => '1', 'ordering' => '0',]);
        $createAnnouncements = Permission::create(['name' => 'create_announcements', 'display_name' => 'إنشاء إعلان', 'description' => 'إنشاء إعلان جديدة', 'display_name_en' => 'Create Announcement', 'description_en' => 'Create a new announcement', 'route' => 'announcements/create', 'module' => 'announcements', 'as' => 'announcements.create', 'icon' => null, 'parent' => $manageAnnouncements->id, 'parent_show' => $manageAnnouncements->id, 'parent_original' => $manageAnnouncements->id, 'appear' => '0', 'ordering' => '0',]);
        $displayAnnouncement = Permission::create(['name' => 'display_announcements', 'display_name' => 'عرض الإعلان', 'description' => 'عرض تفاصيل الإعلان', 'display_name_en' => 'Show Announcement', 'description_en' => 'Show announcement details', 'route' => 'announcements/{announcements}', 'module' => 'announcements', 'as' => 'announcements.show', 'icon' => null, 'parent' => $manageAnnouncements->id, 'parent_show' => $manageAnnouncements->id, 'parent_original' => $manageAnnouncements->id, 'appear' => '0', 'ordering' => '0',]);
        $updateAnnouncements = Permission::create(['name' => 'update_announcements', 'display_name' => 'تعديل الإعلان', 'description' => 'تحديث تفاصيل الإعلان', 'display_name_en' => 'Update Announcement', 'description_en' => 'Update announcement details', 'route' => 'announcements/{announcements}/edit', 'module' => 'announcements', 'as' => 'announcements.edit', 'icon' => null, 'parent' => $manageAnnouncements->id, 'parent_show' => $manageAnnouncements->id, 'parent_original' => $manageAnnouncements->id, 'appear' => '0', 'ordering' => '0',]);
        $destroyAnnouncements = Permission::create(['name' => 'delete_announcements', 'display_name' => 'حذف الإعلان', 'description' => 'حذف الإعلان', 'display_name_en' => 'Delete Announcement', 'description_en' => 'Delete announcement', 'route' => 'announcements/{announcements}', 'module' => 'announcements', 'as' => 'announcements.delete', 'icon' => null, 'parent' => $manageAnnouncements->id, 'parent_show' => $manageAnnouncements->id, 'parent_original' => $manageAnnouncements->id, 'appear' => '0', 'ordering' => '0',]);


       /* // POSTS COMMENTS
        $manageComments = Permission::create([ 'name' => 'manage_post_comments', 'display_name' => 'Comments', 'route' => 'post_comments', 'module' => 'post_comments', 'as' => 'post_comments.index', 'icon' => 'fas fa-comments-alt', 'parent' => $managePosts->id, 'parent_original' => '0', 'appear' => '0', 'ordering' => '10', ]);
        $manageComments->parent_show = $manageComments->id; $manageComments->save();
        $showComments = Permission::create([ 'name' => 'show_post_comments', 'display_name' => 'Comments', 'route' => 'post_comments', 'module' => 'post_comments', 'as' => 'post_comments.index', 'icon' => 'fas fa-comments-alt', 'parent' => $managePosts->id, 'parent_show' => $managePosts->id, 'parent_original' => $manageComments->id, 'appear' => '1', 'ordering' => '0', ]);
        $createComments = Permission::create([ 'name' => 'create_post_comments', 'display_name' => 'Create Comment', 'route' => 'post_comments/create', 'module' => 'post_comments', 'as' => 'post_comments.create', 'icon' => null, 'parent' => $managePosts->id, 'parent_show' => $managePosts->id, 'parent_original' => $manageComments->id, 'appear' => '0', 'ordering' => '0',]);
        $updateComments = Permission::create([ 'name' => 'update_post_comments', 'display_name' => 'Update Comment', 'route' => 'post_comments/{post_comments}/edit', 'module' => 'post_comments', 'as' => 'post_comments.edit', 'icon' => null, 'parent' => $managePosts->id, 'parent_show' => $managePosts->id, 'parent_original' => $manageComments->id, 'appear' => '0', 'ordering' => '0', ]);
        $destroyComments = Permission::create([ 'name' => 'delete_post_comments', 'display_name' => 'Delete Comment', 'route' => 'post_comments/{post_comments}', 'module' => 'post_comments', 'as' => 'post_comments.delete', 'icon' => null, 'parent' => $managePosts->id, 'parent_show' => $managePosts->id, 'parent_original' => $manageComments->id, 'appear' => '0', 'ordering' => '0', ]);*/

        // POSTS COMMENTS
        $manageComments = Permission::create(['name' => 'manage_post_comments', 'display_name' => 'التعليقات', 'description' => 'إدارة التعليقات', 'display_name_en' => 'Comments', 'description_en' => 'Manage Comments', 'route' => 'post_comments', 'module' => 'post_comments', 'as' => 'post_comments.index', 'icon' => 'fas fa-comments-alt', 'parent' => $managePosts->id, 'parent_original' => '0', 'appear' => '0', 'ordering' => '10',]);
        $manageComments->parent_show = $manageComments->id;$manageComments->save();
        $showComments = Permission::create(['name' => 'show_post_comments', 'display_name' => 'عرض التعليقات', 'description' => 'عرض التعليقات', 'display_name_en' => 'Show Comments', 'description_en' => 'Show Comments', 'route' => 'post_comments', 'module' => 'post_comments', 'as' => 'post_comments.index', 'icon' => 'fas fa-comments-alt', 'parent' => $managePosts->id, 'parent_show' => $manageComments->id, 'parent_original' => $manageComments->id, 'appear' => '1', 'ordering' => '0',]);
        $createComments = Permission::create(['name' => 'create_post_comments', 'display_name' => 'إنشاء تعليق', 'description' => 'إنشاء تعليق جديد', 'display_name_en' => 'Create Comment', 'description_en' => 'Create a new comment', 'route' => 'post_comments/create', 'module' => 'post_comments', 'as' => 'post_comments.create', 'icon' => null, 'parent' => $managePosts->id, 'parent_show' => $manageComments->id, 'parent_original' => $manageComments->id, 'appear' => '0', 'ordering' => '0',]);
        $updateComments = Permission::create(['name' => 'update_post_comments', 'display_name' => 'تحديث التعليق', 'description' => 'تحديث تفاصيل التعليق', 'display_name_en' => 'Update Comment', 'description_en' => 'Update comment details', 'route' => 'post_comments/{post_comments}/edit', 'module' => 'post_comments', 'as' => 'post_comments.edit', 'icon' => null, 'parent' => $managePosts->id, 'parent_show' => $manageComments->id, 'parent_original' => $manageComments->id, 'appear' => '0', 'ordering' => '0',]);
        $destroyComments = Permission::create(['name' => 'delete_post_comments', 'display_name' => 'حذف التعليق', 'description' => 'حذف التعليق', 'display_name_en' => 'Delete Comment', 'description_en' => 'Delete comment', 'route' => 'post_comments/{post_comments}', 'module' => 'post_comments', 'as' => 'post_comments.delete', 'icon' => null, 'parent' => $managePosts->id, 'parent_show' => $manageComments->id, 'parent_original' => $manageComments->id, 'appear' => '0', 'ordering' => '0',]);

/*        // POSTS CATEGORIES
        $managePostCategories = Permission::create([ 'name' => 'manage_post_categories', 'display_name' => 'Categories', 'route' => 'post_categories', 'module' => 'post_categories', 'as' => 'post_categories.index', 'icon' => 'fas fa-file-archive', 'parent' => $managePosts->id, 'parent_original' => '0', 'appear' => '0', 'ordering' => '15', ]);
        $managePostCategories->parent_show = $managePostCategories->id; $managePostCategories->save();
        $showPostCategories = Permission::create([ 'name' => 'show_post_categories', 'display_name' => 'Categories', 'route' => 'post_categories', 'module' => 'post_categories', 'as' => 'post_categories.index', 'icon' => 'fas fa-file-archive', 'parent' => $managePosts->id, 'parent_show' => $managePosts->id, 'parent_original' => $managePostCategories->id, 'appear' => '1', 'ordering' => '0', ]);
        $createPostCategories = Permission::create([ 'name' => 'create_post_categories', 'display_name' => 'Create Category', 'route' => 'post_categories/create', 'module' => 'post_categories', 'as' => 'post_categories.create', 'icon' => null, 'parent' => $managePosts->id, 'parent_show' => $managePosts->id, 'parent_original' => $managePostCategories->id, 'appear' => '0', 'ordering' => '0',]);
        $updatePostCategories = Permission::create([ 'name' => 'update_post_categories', 'display_name' => 'Update Category', 'route' => 'post_categories/{post_categories}/edit', 'module' => 'post_categories', 'as' => 'post_categories.edit', 'icon' => null, 'parent' => $managePosts->id, 'parent_show' => $managePosts->id, 'parent_original' => $managePostCategories->id, 'appear' => '0', 'ordering' => '0', ]);
        $destroyPostCategories = Permission::create([ 'name' => 'delete_post_categories', 'display_name' => 'Delete Category', 'route' => 'post_categories/{post_categories}', 'module' => 'post_categories', 'as' => 'post_categories.delete', 'icon' => null, 'parent' => $managePosts->id, 'parent_show' => $managePosts->id, 'parent_original' => $managePostCategories->id, 'appear' => '0', 'ordering' => '0', ]);*/

        // POSTS CATEGORIES
        $managePostCategories = Permission::create(['name' => 'manage_post_categories', 'display_name' => ' الأقسام', 'description' => 'إدارة  الأقسام', 'display_name_en' => 'Categories', 'description_en' => 'Manage Categories', 'route' => 'post_categories', 'module' => 'post_categories', 'as' => 'post_categories.index', 'icon' => 'fas fa-file-archive', 'parent' => $managePosts->id, 'parent_original' => '0', 'appear' => '0', 'ordering' => '15',]);
        $managePostCategories->parent_show = $managePostCategories->id;$managePostCategories->save();
        $showPostCategories = Permission::create(['name' => 'show_post_categories', 'display_name' => 'عرض  الأقسام', 'description' => 'عرض  الأقسام', 'display_name_en' => 'Show Categories', 'description_en' => 'Show Categories', 'route' => 'post_categories', 'module' => 'post_categories', 'as' => 'post_categories.index', 'icon' => 'fas fa-file-archive', 'parent' => $managePosts->id, 'parent_show' => $managePostCategories->id, 'parent_original' => $managePostCategories->id, 'appear' => '1', 'ordering' => '0',]);
        $createPostCategories = Permission::create(['name' => 'create_post_categories', 'display_name' => 'إنشاء  قسم', 'description' => 'إنشاء  قسم جديدة', 'display_name_en' => 'Create Category', 'description_en' => 'Create a new category', 'route' => 'post_categories/create', 'module' => 'post_categories', 'as' => 'post_categories.create', 'icon' => null, 'parent' => $managePosts->id, 'parent_show' => $managePostCategories->id, 'parent_original' => $managePostCategories->id, 'appear' => '0', 'ordering' => '0',]);
        $updatePostCategories = Permission::create(['name' => 'update_post_categories', 'display_name' => 'تحديث القسم', 'description' => 'تحديث تفاصيل القسم', 'display_name_en' => 'Update Category', 'description_en' => 'Update category details', 'route' => 'post_categories/{post_categories}/edit', 'module' => 'post_categories', 'as' => 'post_categories.edit', 'icon' => null, 'parent' => $managePosts->id, 'parent_show' => $managePostCategories->id, 'parent_original' => $managePostCategories->id, 'appear' => '0', 'ordering' => '0',]);
        $destroyPostCategories = Permission::create(['name' => 'delete_post_categories', 'display_name' => 'حذف القسم', 'description' => 'حذف القسم', 'display_name_en' => 'Delete Category', 'description_en' => 'Delete category', 'route' => 'post_categories/{post_categories}', 'module' => 'post_categories', 'as' => 'post_categories.delete', 'icon' => null, 'parent' => $managePosts->id, 'parent_show' => $managePostCategories->id, 'parent_original' => $managePostCategories->id, 'appear' => '0', 'ordering' => '0',]);

/*        // POSTS TAGS
        $managePostTags = Permission::create([ 'name' => 'manage_post_tags', 'display_name' => 'Tags', 'route' => 'post_tags', 'module' => 'post_tags', 'as' => 'post_tags.index', 'icon' => 'fas fa-tags', 'parent' => $managePosts->id, 'parent_original' => '0', 'appear' => '0', 'ordering' => '16', ]);
        $managePostTags->parent_show = $managePostTags->id; $managePostTags->save();
        $showPostTags = Permission::create([ 'name' => 'show_post_tags', 'display_name' => 'Tags', 'route' => 'post_tags', 'module' => 'post_tags', 'as' => 'post_tags.index', 'icon' => 'fas fa-tags', 'parent' => $managePosts->id, 'parent_show' => $managePosts->id, 'parent_original' => $managePostTags->id, 'appear' => '1', 'ordering' => '0', ]);
        $createPostTags = Permission::create([ 'name' => 'create_post_tags', 'display_name' => 'Create Tag', 'route' => 'post_tags/create', 'module' => 'post_tags', 'as' => 'post_tags.create', 'icon' => null, 'parent' => $managePosts->id, 'parent_show' => $managePosts->id, 'parent_original' => $managePostTags->id, 'appear' => '0', 'ordering' => '0',]);
        $updatePostTags = Permission::create([ 'name' => 'update_post_tags', 'display_name' => 'Update Tag', 'route' => 'post_tags/{post_tags}/edit', 'module' => 'post_tags', 'as' => 'post_tags.edit', 'icon' => null, 'parent' => $managePosts->id, 'parent_show' => $managePosts->id, 'parent_original' => $managePostTags->id, 'appear' => '0', 'ordering' => '0', ]);
        $destroyPostTags = Permission::create([ 'name' => 'delete_post_tags', 'display_name' => 'Delete Tag', 'route' => 'post_tags/{post_tags}', 'module' => 'post_tags', 'as' => 'post_tags.delete', 'icon' => null, 'parent' => $managePosts->id, 'parent_show' => $managePosts->id, 'parent_original' => $managePostTags->id, 'appear' => '0', 'ordering' => '0', ]);*/

        // POSTS TAGS
        $managePostTags = Permission::create(['name' => 'manage_post_tags', 'display_name' => 'الكلمات المفتاحية', 'description' => 'إدارة الكلمات المفتاحية', 'display_name_en' => 'Tags', 'description_en' => 'Manage Tags', 'route' => 'post_tags', 'module' => 'post_tags', 'as' => 'post_tags.index', 'icon' => 'fas fa-tags', 'parent' => $managePosts->id, 'parent_original' => '0', 'appear' => '0', 'ordering' => '16',]);
        $managePostTags->parent_show = $managePostTags->id;$managePostTags->save();
        $showPostTags = Permission::create(['name' => 'show_post_tags', 'display_name' => 'عرض الكلمات المفتاحية', 'description' => 'عرض الكلمات المفتاحية', 'display_name_en' => 'Show Tags', 'description_en' => 'Show Tags', 'route' => 'post_tags', 'module' => 'post_tags', 'as' => 'post_tags.index', 'icon' => 'fas fa-tags', 'parent' => $managePosts->id, 'parent_show' => $managePostTags->id, 'parent_original' => $managePostTags->id, 'appear' => '1', 'ordering' => '0',]);
        $createPostTags = Permission::create(['name' => 'create_post_tags', 'display_name' => 'إنشاء كلمة مفتاحية', 'description' => 'إنشاء كلمة مفتاحية جديدة', 'display_name_en' => 'Create Tag', 'description_en' => 'Create a new tag', 'route' => 'post_tags/create', 'module' => 'post_tags', 'as' => 'post_tags.create', 'icon' => null, 'parent' => $managePosts->id, 'parent_show' => $managePostTags->id, 'parent_original' => $managePostTags->id, 'appear' => '0', 'ordering' => '0',]);
        $updatePostTags = Permission::create(['name' => 'update_post_tags', 'display_name' => 'تحديث الكلمة المفتاحية', 'description' => 'تحديث تفاصيل الكلمة المفتاحية', 'display_name_en' => 'Update Tag', 'description_en' => 'Update tag details', 'route' => 'post_tags/{post_tags}/edit', 'module' => 'post_tags', 'as' => 'post_tags.edit', 'icon' => null, 'parent' => $managePosts->id, 'parent_show' => $managePostTags->id, 'parent_original' => $managePostTags->id, 'appear' => '0', 'ordering' => '0',]);
        $destroyPostTags = Permission::create(['name' => 'delete_post_tags', 'display_name' => 'حذف الكلمة المفتاحية', 'description' => 'حذف الكلمة المفتاحية', 'display_name_en' => 'Delete Tag', 'description_en' => 'Delete tag', 'route' => 'post_tags/{post_tags}', 'module' => 'post_tags', 'as' => 'post_tags.delete', 'icon' => null, 'parent' => $managePosts->id, 'parent_show' => $managePostTags->id, 'parent_original' => $managePostTags->id, 'appear' => '0', 'ordering' => '0',]);

       /* // PAGES
        $managePages = Permission::create([ 'name' => 'manage_pages', 'display_name' => 'Pages', 'route' => 'pages', 'module' => 'pages', 'as' => 'pages.index', 'icon' => 'fas fa-file', 'parent' => '0', 'parent_original' => '0', 'appear' => '1', 'ordering' => '20', ]);
        $managePages->parent_show = $managePages->id; $managePages->save();
        $showPages = Permission::create([ 'name' => 'show_pages', 'display_name' => 'Pages', 'route' => 'pages', 'module' => 'pages', 'as' => 'pages.index', 'icon' => 'fas fa-file', 'parent' => $managePages->id, 'parent_show' => $managePages->id, 'parent_original' => $managePages->id, 'appear' => '1', 'ordering' => '0', ]);
        $createPages = Permission::create([ 'name' => 'create_pages', 'display_name' => 'Create Page', 'route' => 'pages/create', 'module' => 'pages', 'as' => 'pages.create', 'icon' => null, 'parent' => $managePages->id, 'parent_show' => $managePages->id, 'parent_original' => $managePages->id, 'appear' => '0', 'ordering' => '0',]);
        $displayPages = Permission::create([ 'name' => 'display_pages', 'display_name' => 'Show Page', 'route' => 'pages/{pages}', 'module' => 'pages', 'as' => 'pages.show', 'icon' => null, 'parent' => $managePages->id, 'parent_show' => $managePages->id, 'parent_original' => $managePages->id, 'appear' => '0', 'ordering' => '0', ]);
        $updatePages = Permission::create([ 'name' => 'update_pages', 'display_name' => 'Update Page', 'route' => 'pages/{pages}/edit', 'module' => 'pages', 'as' => 'pages.edit', 'icon' => null, 'parent' => $managePages->id, 'parent_show' => $managePages->id, 'parent_original' => $managePages->id, 'appear' => '0', 'ordering' => '0', ]);
        $destroyPages = Permission::create([ 'name' => 'delete_pages', 'display_name' => 'Delete Page', 'route' => 'pages/{pages}', 'module' => 'pages', 'as' => 'pages.delete', 'icon' => null, 'parent' => $managePages->id, 'parent_show' => $managePages->id, 'parent_original' => $managePages->id, 'appear' => '0', 'ordering' => '0', ]);*/

        // PAGES
        $managePages = Permission::create([
            'name' => 'manage_pages',
            'display_name' => 'الصفحات',
            'description' => 'إدارة الصفحات',
            'display_name_en' => 'Pages',
            'description_en' => 'Manage Pages',
            'route' => 'pages',
            'module' => 'pages',
            'as' => 'pages.index',
            'icon' => 'fas fa-file',
            'parent' => '0',
            'parent_original' => '0',
            'appear' => '1',
            'ordering' => '20',
        ]);
        $managePages->parent_show = $managePages->id;
        $managePages->save();

        $showPages = Permission::create([
            'name' => 'show_pages',
            'display_name' => 'عرض الصفحات',
            'description' => 'عرض الصفحات',
            'display_name_en' => 'Show Pages',
            'description_en' => 'Show Pages',
            'route' => 'pages',
            'module' => 'pages',
            'as' => 'pages.index',
            'icon' => 'fas fa-file',
            'parent' => $managePages->id,
            'parent_show' => $managePages->id,
            'parent_original' => $managePages->id,
            'appear' => '1',
            'ordering' => '0',
        ]);

        $createPages = Permission::create([
            'name' => 'create_pages',
            'display_name' => 'إنشاء صفحة',
            'description' => 'إنشاء صفحة جديدة',
            'display_name_en' => 'Create Page',
            'description_en' => 'Create a new page',
            'route' => 'pages/create',
            'module' => 'pages',
            'as' => 'pages.create',
            'icon' => null,
            'parent' => $managePages->id,
            'parent_show' => $managePages->id,
            'parent_original' => $managePages->id,
            'appear' => '0',
            'ordering' => '0',
        ]);

        $displayPages = Permission::create([
            'name' => 'display_pages',
            'display_name' => 'عرض الصفحة',
            'description' => 'عرض الصفحة',
            'display_name_en' => 'Show Page',
            'description_en' => 'Show Page',
            'route' => 'pages/{pages}',
            'module' => 'pages',
            'as' => 'pages.show',
            'icon' => null,
            'parent' => $managePages->id,
            'parent_show' => $managePages->id,
            'parent_original' => $managePages->id,
            'appear' => '0',
            'ordering' => '0',
        ]);

        $updatePages = Permission::create([
            'name' => 'update_pages',
            'display_name' => 'تحديث الصفحة',
            'description' => 'تحديث تفاصيل الصفحة',
            'display_name_en' => 'Update Page',
            'description_en' => 'Update page details',
            'route' => 'pages/{pages}/edit',
            'module' => 'pages',
            'as' => 'pages.edit',
            'icon' => null,
            'parent' => $managePages->id,
            'parent_show' => $managePages->id,
            'parent_original' => $managePages->id,
            'appear' => '0',
            'ordering' => '0',
        ]);

        $destroyPages = Permission::create([
            'name' => 'delete_pages',
            'display_name' => 'حذف الصفحة',
            'description' => 'حذف الصفحة',
            'display_name_en' => 'Delete Page',
            'description_en' => 'Delete Page',
            'route' => 'pages/{pages}',
            'module' => 'pages',
            'as' => 'pages.delete',
            'icon' => null,
            'parent' => $managePages->id,
            'parent_show' => $managePages->id,
            'parent_original' => $managePages->id,
            'appear' => '0',
            'ordering' => '0',
        ]);


        /*// Contact Us
        $manageContactUs = Permission::create([ 'name' => 'manage_contact_us', 'display_name' => 'Contact Us', 'route' => 'contact_us', 'module' => 'contact_us', 'as' => 'contact_us.index', 'icon' => 'fas fa-envelope', 'parent' => '0', 'parent_original' => '0', 'appear' => '1', 'ordering' => '20', ]);
        $manageContactUs->parent_show = $manageContactUs->id; $manageContactUs->save();
        $showContactUs = Permission::create([ 'name' => 'show_contact_us', 'display_name' => 'Contact Us', 'route' => 'contact_us', 'module' => 'contact_us', 'as' => 'contact_us.index', 'icon' => 'fas fa-envelope', 'parent' => $manageContactUs->id, 'parent_show' => $manageContactUs->id, 'parent_original' => $manageContactUs->id, 'appear' => '1', 'ordering' => '0', ]);
        $displayContactUs = Permission::create([ 'name' => 'display_contact_us', 'display_name' => 'Display Message', 'route' => 'contact_us/{contact_us}', 'module' => 'contact_us', 'as' => 'contact_us.show', 'icon' => null, 'parent' => $manageContactUs->id, 'parent_show' => $manageContactUs->id, 'parent_original' => $manageContactUs->id, 'appear' => '0', 'ordering' => '0',]);
        $updateContactUs = Permission::create([ 'name' => 'update_contact_us', 'display_name' => 'Update Message', 'route' => 'contact_us/{contact_us}/edit', 'module' => 'contact_us', 'as' => 'contact_us.edit', 'icon' => null, 'parent' => $manageContactUs->id, 'parent_show' => $manageContactUs->id, 'parent_original' => $manageContactUs->id, 'appear' => '0', 'ordering' => '0', ]);
        $destroyContactUs = Permission::create([ 'name' => 'delete_contact_us', 'display_name' => 'Delete Message', 'route' => 'contact_us/{contact_us}', 'module' => 'contact_us', 'as' => 'contact_us.delete', 'icon' => null, 'parent' => $manageContactUs->id, 'parent_show' => $manageContactUs->id, 'parent_original' => $manageContactUs->id, 'appear' => '0', 'ordering' => '0', ]);*/


        // Contact Us
        $manageContactUs = Permission::create([
            'name' => 'manage_contact_us',
            'display_name' => 'اتصل بنا',
            'description' => 'إدارة اتصل بنا',
            'display_name_en' => 'Contact Us',
            'description_en' => 'Manage Contact Us',
            'route' => 'contact_us',
            'module' => 'contact_us',
            'as' => 'contact_us.index',
            'icon' => 'fas fa-envelope',
            'parent' => '0',
            'parent_original' => '0',
            'appear' => '1',
            'ordering' => '20',
        ]);
        $manageContactUs->parent_show = $manageContactUs->id;
        $manageContactUs->save();

        $showContactUs = Permission::create([
            'name' => 'show_contact_us',
            'display_name' => 'عرض اتصل بنا',
            'description' => 'عرض اتصل بنا',
            'display_name_en' => 'Show Contact Us',
            'description_en' => 'Show Contact Us',
            'route' => 'contact_us',
            'module' => 'contact_us',
            'as' => 'contact_us.index',
            'icon' => 'fas fa-envelope',
            'parent' => $manageContactUs->id,
            'parent_show' => $manageContactUs->id,
            'parent_original' => $manageContactUs->id,
            'appear' => '1',
            'ordering' => '0',
        ]);

        $displayContactUs = Permission::create([
            'name' => 'display_contact_us',
            'display_name' => 'عرض الرسالة',
            'description' => 'عرض الرسالة',
            'display_name_en' => 'Display Message',
            'description_en' => 'Display Message',
            'route' => 'contact_us/{contact_us}',
            'module' => 'contact_us',
            'as' => 'contact_us.show',
            'icon' => null,
            'parent' => $manageContactUs->id,
            'parent_show' => $manageContactUs->id,
            'parent_original' => $manageContactUs->id,
            'appear' => '0',
            'ordering' => '0',
        ]);

        $updateContactUs = Permission::create([
            'name' => 'update_contact_us',
            'display_name' => 'تحديث الرسالة',
            'description' => 'تحديث تفاصيل الرسالة',
            'display_name_en' => 'Update Message',
            'description_en' => 'Update Message details',
            'route' => 'contact_us/{contact_us}/edit',
            'module' => 'contact_us',
            'as' => 'contact_us.edit',
            'icon' => null,
            'parent' => $manageContactUs->id,
            'parent_show' => $manageContactUs->id,
            'parent_original' => $manageContactUs->id,
            'appear' => '0',
            'ordering' => '0',
        ]);

        $destroyContactUs = Permission::create([
            'name' => 'delete_contact_us',
            'display_name' => 'حذف الرسالة',
            'description' => 'حذف الرسالة',
            'display_name_en' => 'Delete Message',
            'description_en' => 'Delete Message',
            'route' => 'contact_us/{contact_us}',
            'module' => 'contact_us',
            'as' => 'contact_us.delete',
            'icon' => null,
            'parent' => $manageContactUs->id,
            'parent_show' => $manageContactUs->id,
            'parent_original' => $manageContactUs->id,
            'appear' => '0',
            'ordering' => '0',
        ]);

/*        // USERS
        $manageUsers = Permission::create([ 'name' => 'manage_users', 'display_name' => 'Users', 'route' => 'users', 'module' => 'users', 'as' => 'users.index', 'icon' => 'fas fa-user', 'parent' => '0', 'parent_original' => '0', 'appear' => '1', 'ordering' => '20', ]);
        $manageUsers->parent_show = $manageUsers->id; $manageUsers->save();
        $showUsers = Permission::create([ 'name' => 'show_users', 'display_name' => 'Users', 'route' => 'users', 'module' => 'users', 'as' => 'users.index', 'icon' => 'fas fa-user', 'parent' => $manageUsers->id, 'parent_show' => $manageUsers->id, 'parent_original' => $manageUsers->id, 'appear' => '1', 'ordering' => '0', ]);
        $createUsers = Permission::create([ 'name' => 'create_users', 'display_name' => 'Create User', 'route' => 'users/create', 'module' => 'users', 'as' => 'users.create', 'icon' => null, 'parent' => $manageUsers->id, 'parent_show' => $manageUsers->id, 'parent_original' => $manageUsers->id, 'appear' => '0', 'ordering' => '0',]);
        $displayUsers = Permission::create([ 'name' => 'display_users', 'display_name' => 'Show User', 'route' => 'users/{users}', 'module' => 'users', 'as' => 'users.show', 'icon' => null, 'parent' => $manageUsers->id, 'parent_show' => $manageUsers->id, 'parent_original' => $manageUsers->id, 'appear' => '0', 'ordering' => '0',]);
        $updateUsers = Permission::create([ 'name' => 'update_users', 'display_name' => 'Update User', 'route' => 'users/{users}/edit', 'module' => 'users', 'as' => 'users.edit', 'icon' => null, 'parent' => $manageUsers->id, 'parent_show' => $manageUsers->id, 'parent_original' => $manageUsers->id, 'appear' => '0', 'ordering' => '0', ]);
        $destroyUsers = Permission::create([ 'name' => 'delete_users', 'display_name' => 'Delete User', 'route' => 'users/{users}', 'module' => 'users', 'as' => 'users.delete', 'icon' => null, 'parent' => $manageUsers->id, 'parent_show' => $manageUsers->id, 'parent_original' => $manageUsers->id, 'appear' => '0', 'ordering' => '0', ]);
*/
        // USERS
        $manageUsers = Permission::create([
            'name' => 'manage_users',
            'display_name' => 'إدارة المستخدمين',
            'description' => 'إدارة المستخدمين',
            'display_name_en' => 'Users',
            'description_en' => 'Manage Users',
            'route' => 'users',
            'module' => 'users',
            'as' => 'users.index',
            'icon' => 'fas fa-user',
            'parent' => '0',
            'parent_original' => '0',
            'appear' => '1',
            'ordering' => '20',
        ]);
        $manageUsers->parent_show = $manageUsers->id;
        $manageUsers->save();

        $showUsers = Permission::create([
            'name' => 'show_users',
            'display_name' => 'المستخدمين',
            'description' => 'عرض المستخدمين',
            'display_name_en' => 'Users',
            'description_en' => 'Show Users',
            'route' => 'users',
            'module' => 'users',
            'as' => 'users.index',
            'icon' => 'fas fa-user',
            'parent' => $manageUsers->id,
            'parent_show' => $manageUsers->id,
            'parent_original' => $manageUsers->id,
            'appear' => '1',
            'ordering' => '0',
        ]);

        $createUsers = Permission::create([
            'name' => 'create_users',
            'display_name' => 'إنشاء مستخدم',
            'description' => 'إنشاء مستخدم جديد',
            'display_name_en' => 'Create User',
            'description_en' => 'Create User',
            'route' => 'users/create',
            'module' => 'users',
            'as' => 'users.create',
            'icon' => null,
            'parent' => $manageUsers->id,
            'parent_show' => $manageUsers->id,
            'parent_original' => $manageUsers->id,
            'appear' => '0',
            'ordering' => '0',
        ]);

        $displayUsers = Permission::create([
            'name' => 'display_users',
            'display_name' => 'عرض المستخدم',
            'description' => 'عرض تفاصيل المستخدم',
            'display_name_en' => 'Show User',
            'description_en' => 'Show User',
            'route' => 'users/{users}',
            'module' => 'users',
            'as' => 'users.show',
            'icon' => null,
            'parent' => $manageUsers->id,
            'parent_show' => $manageUsers->id,
            'parent_original' => $manageUsers->id,
            'appear' => '0',
            'ordering' => '0',
        ]);

        $updateUsers = Permission::create([
            'name' => 'update_users',
            'display_name' => 'تحديث المستخدم',
            'description' => 'تحديث بيانات المستخدم',
            'display_name_en' => 'Update User',
            'description_en' => 'Update User',
            'route' => 'users/{users}/edit',
            'module' => 'users',
            'as' => 'users.edit',
            'icon' => null,
            'parent' => $manageUsers->id,
            'parent_show' => $manageUsers->id,
            'parent_original' => $manageUsers->id,
            'appear' => '0',
            'ordering' => '0',
        ]);

        $destroyUsers = Permission::create([
            'name' => 'delete_users',
            'display_name' => 'حذف المستخدم',
            'description' => 'حذف المستخدم',
            'display_name_en' => 'Delete User',
            'description_en' => 'Delete User',
            'route' => 'users/{users}',
            'module' => 'users',
            'as' => 'users.delete',
            'icon' => null,
            'parent' => $manageUsers->id,
            'parent_show' => $manageUsers->id,
            'parent_original' => $manageUsers->id,
            'appear' => '0',
            'ordering' => '0',
        ]);

        /*
        // E
        // SUPERVISORS
        $manageSupervisors = Permission::create([ 'name' => 'manage_supervisors', 'display_name' => 'Supervisors', 'route' => 'supervisor', 'module' => 'supervisor', 'as' => 'supervisor.index', 'icon' => 'fas fa-user-shield', 'parent' => '0', 'parent_original' => '0', 'appear' => '0', 'ordering' => '700', 'sidebar_link' => '0']);
        $manageSupervisors->parent_show = $manageSupervisors->id; $manageSupervisors->save();
        $showSupervisors = Permission::create([ 'name' => 'show_supervisors', 'display_name' => 'Supervisors', 'route' => 'supervisor', 'module' => 'supervisor', 'as' => 'supervisor.index', 'icon' => 'fas fa-user-shield', 'parent' => $manageSupervisors->id, 'parent_show' => $manageSupervisors->id, 'parent_original' => $manageSupervisors->id, 'appear' => '1', 'ordering' => '0', 'sidebar_link' => '0']);
        $createSupervisors = Permission::create([ 'name' => 'create_supervisors', 'display_name' => 'Create Supervisor', 'route' => 'supervisor/create', 'module' => 'supervisor', 'as' => 'supervisor.create', 'icon' => null, 'parent' => $manageSupervisors->id, 'parent_show' => $manageSupervisors->id, 'parent_original' => $manageSupervisors->id, 'appear' => '0', 'ordering' => '0', 'sidebar_link' => '0']);
        $displaySupervisors = Permission::create([ 'name' => 'display_supervisors', 'display_name' => 'Show Supervisor', 'route' => 'supervisor/{supervisor}', 'module' => 'supervisor', 'as' => 'supervisor.show', 'icon' => null, 'parent' => $manageSupervisors->id, 'parent_show' => $manageSupervisors->id, 'parent_original' => $manageSupervisors->id, 'appear' => '0', 'ordering' => '0', 'sidebar_link' => '0']);
        $updateSupervisors = Permission::create([ 'name' => 'update_supervisors', 'display_name' => 'Update Supervisor', 'route' => 'supervisor/{supervisor}/edit', 'module' => 'supervisor', 'as' => 'supervisor.edit', 'icon' => null, 'parent' => $manageSupervisors->id, 'parent_show' => $manageSupervisors->id, 'parent_original' => $manageSupervisors->id, 'appear' => '0', 'ordering' => '0', 'sidebar_link' => '0']);
        $destroySupervisors = Permission::create([ 'name' => 'delete_supervisors', 'display_name' => 'Delete Supervisor', 'route' => 'supervisor/{supervisor}', 'module' => 'supervisor', 'as' => 'supervisor.delete', 'icon' => null, 'parent' => $manageSupervisors->id, 'parent_show' => $manageSupervisors->id, 'parent_original' => $manageSupervisors->id, 'appear' => '0', 'ordering' => '0', 'sidebar_link' => '0']);*/


        // EDITORS
        // SUPERVISORS
        $manageSupervisors = Permission::create([
            'name' => 'manage_supervisors',
            'display_name' => 'المشرفين',
            'description' => 'إدارة المشرفين',
            'display_name_en' => 'Supervisors',
            'description_en' => 'Manage Supervisors',
            'route' => 'supervisor',
            'module' => 'supervisor',
            'as' => 'supervisor.index',
            'icon' => 'fas fa-user-shield',
            'parent' => '0',
            'parent_original' => '0',
            'appear' => '0',
            'ordering' => '700',
            'sidebar_link' => '0',
        ]);
        $manageSupervisors->parent_show = $manageSupervisors->id;
        $manageSupervisors->save();

        $showSupervisors = Permission::create([
            'name' => 'show_supervisors',
            'display_name' => 'المشرفين',
            'description' => 'عرض المشرفين',
            'display_name_en' => 'Supervisors',
            'description_en' => 'Show Supervisors',
            'route' => 'supervisor',
            'module' => 'supervisor',
            'as' => 'supervisor.index',
            'icon' => 'fas fa-user-shield',
            'parent' => $manageSupervisors->id,
            'parent_show' => $manageSupervisors->id,
            'parent_original' => $manageSupervisors->id,
            'appear' => '1',
            'ordering' => '0',
            'sidebar_link' => '0',
        ]);

        $createSupervisors = Permission::create([
            'name' => 'create_supervisors',
            'display_name' => 'إنشاء مشرف',
            'description' => 'إنشاء مشرف جديد',
            'display_name_en' => 'Create Supervisor',
            'description_en' => 'Create Supervisor',
            'route' => 'supervisor/create',
            'module' => 'supervisor',
            'as' => 'supervisor.create',
            'icon' => null,
            'parent' => $manageSupervisors->id,
            'parent_show' => $manageSupervisors->id,
            'parent_original' => $manageSupervisors->id,
            'appear' => '0',
            'ordering' => '0',
            'sidebar_link' => '0',
        ]);

        $displaySupervisors = Permission::create([
            'name' => 'display_supervisors',
            'display_name' => 'عرض المشرف',
            'description' => 'عرض تفاصيل المشرف',
            'display_name_en' => 'Show Supervisor',
            'description_en' => 'Show Supervisor',
            'route' => 'supervisor/{supervisor}',
            'module' => 'supervisor',
            'as' => 'supervisor.show',
            'icon' => null,
            'parent' => $manageSupervisors->id,
            'parent_show' => $manageSupervisors->id,
            'parent_original' => $manageSupervisors->id,
            'appear' => '0',
            'ordering' => '0',
            'sidebar_link' => '0',
        ]);

        $updateSupervisors = Permission::create([
            'name' => 'update_supervisors',
            'display_name' => 'تحديث المشرف',
            'description' => 'تحديث بيانات المشرف',
            'display_name_en' => 'Update Supervisor',
            'description_en' => 'Update Supervisor',
            'route' => 'supervisor/{supervisor}/edit',
            'module' => 'supervisor',
            'as' => 'supervisor.edit',
            'icon' => null,
            'parent' => $manageSupervisors->id,
            'parent_show' => $manageSupervisors->id,
            'parent_original' => $manageSupervisors->id,
            'appear' => '0',
            'ordering' => '0',
            'sidebar_link' => '0',
        ]);

        $destroySupervisors = Permission::create([
            'name' => 'delete_supervisors',
            'display_name' => 'حذف المشرف',
            'description' => 'حذف المشرف',
            'display_name_en' => 'Delete Supervisor',
            'description_en' => 'Delete Supervisor',
            'route' => 'supervisor/{supervisor}',
            'module' => 'supervisor',
            'as' => 'supervisor.delete',
            'icon' => null,
            'parent' => $manageSupervisors->id,
            'parent_show' => $manageSupervisors->id,
            'parent_original' => $manageSupervisors->id,
            'appear' => '0',
            'ordering' => '0',
            'sidebar_link' => '0',
        ]);

       /* // SETTINGS
        $manageSettings = Permission::create([ 'name' => 'manage_settings', 'display_name' => 'Settings', 'route' => 'settings', 'module' => 'settings', 'as' => 'settings.index', 'icon' => 'fas fa-cog', 'parent' => '0', 'parent_original' => '0', 'appear' => '0', 'ordering' => '600', 'sidebar_link' => '0']);
        $manageSettings->parent_show = $manageSettings->id; $manageSettings->save();
        $showSettings = Permission::create([ 'name' => 'show_settings', 'display_name' => 'Settings', 'route' => 'settings', 'module' => 'settings', 'as' => 'settings.index', 'icon' => 'fas fa-cog', 'parent' => $manageSettings->id, 'parent_show' => $manageSettings->id, 'parent_original' => $manageSettings->id, 'appear' => '1', 'ordering' => '0', 'sidebar_link' => '0']);
        $createSettings = Permission::create([ 'name' => 'create_settings', 'display_name' => 'Create Settings', 'route' => 'settings/create', 'module' => 'settings', 'as' => 'settings.create', 'icon' => null, 'parent' => $manageSettings->id, 'parent_show' => $manageSettings->id, 'parent_original' => $manageSettings->id, 'appear' => '0', 'ordering' => '0', 'sidebar_link' => '0']);
        $displaySettings = Permission::create([ 'name' => 'display_settings', 'display_name' => 'Show Settings', 'route' => 'settings/{settings}', 'module' => 'settings', 'as' => 'settings.show', 'icon' => null, 'parent' => $manageSettings->id, 'parent_show' => $manageSettings->id, 'parent_original' => $manageSettings->id, 'appear' => '0', 'ordering' => '0', 'sidebar_link' => '0']);
        $updateSettings = Permission::create([ 'name' => 'update_settings', 'display_name' => 'Update Settings', 'route' => 'settings/{settings}/edit', 'module' => 'settings', 'as' => 'settings.edit', 'icon' => null, 'parent' => $manageSettings->id, 'parent_show' => $manageSettings->id, 'parent_original' => $manageSettings->id, 'appear' => '0', 'ordering' => '0', 'sidebar_link' => '0']);
        $destroySettings = Permission::create([ 'name' => 'delete_settings', 'display_name' => 'Delete Settings', 'route' => 'settings/{settings}', 'module' => 'settings', 'as' => 'settings.delete', 'icon' => null, 'parent' => $manageSettings->id, 'parent_show' => $manageSettings->id, 'parent_original' => $manageSettings->id, 'appear' => '0', 'ordering' => '0', 'sidebar_link' => '0']);*/


        // SETTINGS
        $manageSettings = Permission::create([
            'name' => 'manage_settings',
            'display_name' => 'الإعدادات',
            'description' => 'إدارة الإعدادات',
            'display_name_en' => 'Settings',
            'description_en' => 'Manage Settings',
            'route' => 'settings',
            'module' => 'settings',
            'as' => 'settings.index',
            'icon' => 'fas fa-cog',
            'parent' => '0',
            'parent_original' => '0',
            'appear' => '0',
            'ordering' => '600',
            'sidebar_link' => '0',
        ]);
        $manageSettings->parent_show = $manageSettings->id;
        $manageSettings->save();

        $showSettings = Permission::create([
            'name' => 'show_settings',
            'display_name' => 'الإعدادات',
            'description' => 'عرض الإعدادات',
            'display_name_en' => 'Settings',
            'description_en' => 'Show Settings',
            'route' => 'settings',
            'module' => 'settings',
            'as' => 'settings.index',
            'icon' => 'fas fa-cog',
            'parent' => $manageSettings->id,
            'parent_show' => $manageSettings->id,
            'parent_original' => $manageSettings->id,
            'appear' => '1',
            'ordering' => '0',
            'sidebar_link' => '0',
        ]);

        $createSettings = Permission::create([
            'name' => 'create_settings',
            'display_name' => 'إنشاء إعدادات',
            'description' => 'إنشاء إعدادات جديدة',
            'display_name_en' => 'Create Settings',
            'description_en' => 'Create Settings',
            'route' => 'settings/create',
            'module' => 'settings',
            'as' => 'settings.create',
            'icon' => null,
            'parent' => $manageSettings->id,
            'parent_show' => $manageSettings->id,
            'parent_original' => $manageSettings->id,
            'appear' => '0',
            'ordering' => '0',
            'sidebar_link' => '0',
        ]);

        $displaySettings = Permission::create([
            'name' => 'display_settings',
            'display_name' => 'عرض الإعدادات',
            'description' => 'عرض تفاصيل الإعدادات',
            'display_name_en' => 'Show Settings',
            'description_en' => 'Show Settings',
            'route' => 'settings/{settings}',
            'module' => 'settings',
            'as' => 'settings.show',
            'icon' => null,
            'parent' => $manageSettings->id,
            'parent_show' => $manageSettings->id,
            'parent_original' => $manageSettings->id,
            'appear' => '0',
            'ordering' => '0',
            'sidebar_link' => '0',
        ]);

        $updateSettings = Permission::create([
            'name' => 'update_settings',
            'display_name' => 'تحديث الإعدادات',
            'description' => 'تحديث بيانات الإعدادات',
            'display_name_en' => 'Update Settings',
            'description_en' => 'Update Settings',
            'route' => 'settings/{settings}/edit',
            'module' => 'settings',
            'as' => 'settings.edit',
            'icon' => null,
            'parent' => $manageSettings->id,
            'parent_show' => $manageSettings->id,
            'parent_original' => $manageSettings->id,
            'appear' => '0',
            'ordering' => '0',
            'sidebar_link' => '0',
        ]);

        $destroySettings = Permission::create([
            'name' => 'delete_settings',
            'display_name' => 'حذف الإعدادات',
            'description' => 'حذف الإعدادات',
            'display_name_en' => 'Delete Settings',
            'description_en' => 'Delete Settings',
            'route' => 'settings/{settings}',
            'module' => 'settings',
            'as' => 'settings.delete',
            'icon' => null,
            'parent' => $manageSettings->id,
            'parent_show' => $manageSettings->id,
            'parent_original' => $manageSettings->id,
            'appear' => '0',
            'ordering' => '0',
            'sidebar_link' => '0',
        ]);

    }
}
