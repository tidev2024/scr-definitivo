<?php

namespace App\Models;

use App\Casts\FloatToStringWithComma;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PercentageDirectSalesCommission extends Model
{
    use HasFactory;

    protected $table = 'percentage_direct_sales_commission';

    protected $fillable = ['percent_from', 'percent_to', 'seller_percentage'];

    protected $casts = [
        'percent_from' => FloatToStringWithComma::class,
        'percent_to' => FloatToStringWithComma::class,
        'seller_percentage' => FloatToStringWithComma::class,
    ];
}
