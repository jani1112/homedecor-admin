<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class ManagerCoupon extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'manager_coupons';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const COUPON_STATUS_SELECT = [
        '1' => 'Active',
        '2' => 'Deactive',
    ];

    protected $fillable = [
        'coupon_code',
        'coupon_value',
        'coupon_status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
