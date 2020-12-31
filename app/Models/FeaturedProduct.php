<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class FeaturedProduct extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'featured_products';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const FEATURED_PRODUCT_STATUS_SELECT = [
        '1' => 'Active',
        '2' => 'Deactive',
    ];

    protected $fillable = [
        'featured_product_id',
        'featured_product_status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function featured_product()
    {
        return $this->belongsTo(Product::class, 'featured_product_id');
    }
}
