<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Mindscms\Entrust\EntrustRole;

class Role extends EntrustRole
{
    use HasFactory;
    protected $guarded = [];

    public function display_name ()
    {
        return config('app.locale') == 'ar' ? $this->display_name : $this->display_name_en;
    }

    public function description()
    {
        return config('app.locale') == 'ar' ? $this->description : $this->description_en;
    }

}
