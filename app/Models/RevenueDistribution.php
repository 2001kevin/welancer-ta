<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RevenueDistribution extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'revenue_distributions';
    protected $guarded = ['id'];
}
