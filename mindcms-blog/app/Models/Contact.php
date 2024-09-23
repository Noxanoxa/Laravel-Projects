<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Contact extends Model
{
    use HasFactory, SearchableTrait;

    protected $searchable = [
        'columns' => [
            'contacts.name' => 10,
            'contacts.email' => 10,
            'contacts.mobile' => 10,
            'contacts.title' => 10,
            'contacts.message' => 10,
        ],
    ];
     protected $guarded = [];

     public function status ()
     {
       return $this->status == 1 ? __('Backend/contact_us.read') : __('Backend/contact_us.new');
     }
}
