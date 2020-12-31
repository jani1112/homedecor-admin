<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class ManageOrder extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'manage_orders';

    const PAYMENT_TYPE_SELECT = [
        '1' => 'Cod',
        '2' => 'Online',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const ORDER_STATUS_SELECT = [
        '1' => 'Processing',
        '2' => 'Out For Delivery',
        '3' => 'Delivered',
    ];

    protected $fillable = [
        'bill_no',
        'customerid',
        'total_amount',
        'order_status',
        'total_product',
        'payment_type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
