<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use NumberFormatter;

class Currency extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'currencies';

    public function FormatCurrency(){
        $formatter = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);
    }
}
