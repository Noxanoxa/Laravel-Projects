<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

  protected $guarded = [];
  public $timestamps = false;

    public function display_name ()
    {
        return config('app.locale') == 'ar' ? $this->display_name : $this->display_name_en;
    }



    public function section ()
    {
        return config('app.locale') == 'ar' ? $this->section : $this->section_en;
    }

}
