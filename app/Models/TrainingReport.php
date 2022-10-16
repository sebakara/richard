<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingReport extends Model
{
    use HasFactory;
    protected $table = 'training_reports';
    protected $fillable = ['names', 'gender', 'phone_number', 'nationalId', 'district', 'sector', 'cell', 'date_of_training', 'report_id'];
}
