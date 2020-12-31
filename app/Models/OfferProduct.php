<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class OfferProduct extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'offer_products';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const OFFER_PRODUCT_STATUS_SELECT = [
        '1' => 'Active',
        '2' => 'Deactive',
    ];

    protected $fillable = [
        'offer_product_id',
        'offer_product_status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function offer_product()
    {
        return $this->belongsTo(Product::class, 'offer_product_id');
    }
}
