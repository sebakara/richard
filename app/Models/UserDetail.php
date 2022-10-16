<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;
    protected $table='user_details';
    protected $fillable = ['gender', 'date_of_birth', 'phone_number', 'high_education', 'location', 'image', 'user_id'];
    // , `created_at`, `updated_at` FROM `user_details`
}
