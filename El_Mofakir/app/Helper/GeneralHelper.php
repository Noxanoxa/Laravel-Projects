<?php

use App\Models\Permission;
use Spatie\Valuestore\Valuestore;

function getSettingsOf($key)
{
    $settings = Valuestore::make(config_path('settings.json'));

    return $settings->get($key);
}

function getParentShowOf($param)
{
    $f    = str_replace('admin.', '', $param);
    $perm = Permission::where('as', $f)->first();

    return $perm ? $perm->parent_show : $f;
}

function getParentOf($param)
{
    $f    = str_replace('admin.', '', $param);
    $perm = Permission::where('as', $f)->first();

    return $perm ? $perm->parent : $f;
}

function getParentIdOf($param)
{
    $f    = str_replace('admin.', '', $param);
    $perm = Permission::where('as', $f)->first();

    return $perm ? $perm->id : null;
}

function getIdMenuOf($param)
{
    $perm = Permission::where('id', $param)->first();

    return $perm ? $perm->parent_show : null;
}

function get_gravatar(
    $email,
    $size = 64,
    $default_image_type = 'mp',
    $force_default = false,
    $rating = 'g',
    $return_image = false,
    $html_tag_attributes = []
) {
    // Prepare parameters.
    $params = [
        's' => htmlentities($size),
        'd' => htmlentities($default_image_type),
        'r' => htmlentities($rating),
    ];
    if ($force_default) {
        $params['f'] = 'y';
    }

    // Generate url.
    $base_url = 'https://www.gravatar.com/avatar';
    $hash     = md5(strtolower(trim($email)));
    $query    = http_build_query($params);
    $url      = sprintf('%s/%s?%s', $base_url, $hash, $query);

    // Return image tag if necessary.
    if ($return_image) {
        $attributes = '';
        foreach ($html_tag_attributes as $key => $value) {
            $value      = htmlentities($value, ENT_QUOTES, 'UTF-8');
            $attributes .= sprintf('%s="%s" ', $key, $value);
        }

        return sprintf('<img src="%s" %s/>', $url, $attributes);
    }

    return $url;
}
