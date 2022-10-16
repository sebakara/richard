<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteUser extends Model
{
    use HasFactory;
    protected $table = 'site_users';
    protected $fillable = ['user_id', 'district', 'sector_id', 'cell_id', 'status'];
}
