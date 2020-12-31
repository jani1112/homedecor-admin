<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use \DateTimeInterface;

class Product extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'products';

    protected $appends = [
        'product_img',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const PRODUCT_STATUS_SELECT = [
        '1' => 'Active',
        '2' => 'Deactive',
    ];

    protected $fillable = [
        'catid_id',
        'subcatid_id',
        'product_name',
        'stock',
        'description',
        'price',
        'gst',
        'final_price',
        'hsn_code',
        'offer_price',
        'product_status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function featuredProductFeaturedProducts()
    {
        return $this->hasMany(FeaturedProduct::class, 'featured_product_id', 'id');
    }

    public function offerProductOfferProducts()
    {
        return $this->hasMany(OfferProduct::class, 'offer_product_id', 'id');
    }

    public function getProductImgAttribute()
    {
        $files = $this->getMedia('product_img');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $files;
    }

    public function catid()
    {
        return $this->belongsTo(ProductCategory::class, 'catid_id');
    }

    public function subcatid()
    {
        return $this->belongsTo(SubCategory::class, 'subcatid_id');
    }
}
