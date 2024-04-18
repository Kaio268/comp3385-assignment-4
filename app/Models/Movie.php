<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    // Set the table associated with the model. This is useful if the table's name isn't the pluralized version of the model name.
    protected $table = 'movies';

    // Specify the attributes that can be mass-assigned. This is a security feature to prevent unintended records updates.
    protected $fillable = ['title', 'description', 'poster'];

    // By default, Eloquent expects created_at and updated_at columns to exist on your table.
    // This property enables Laravel to automatically manage these timestamps for you.
    public $timestamps = true;

    // The $casts array is used to cast attributes to native types. This ensures that when the attributes
    // are accessed, they are returned in the specified type, making it easier to work with.
    protected $casts = [
        'created_at' => 'datetime', // Ensures that created_at is treated as a datetime object.
        'updated_at' => 'datetime', // Ensures that updated_at is treated as a datetime object.
    ];

}
