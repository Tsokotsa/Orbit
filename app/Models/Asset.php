<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'serial',
        'vendor_id',
        'media_type',
        'active'

    ];

    // public function medium()
    // {
    //     return $this->belongsTo(Medium::class, 'medium_id');
    // }

    // public function vendor()
    // {
    //     return $this->belongsTo(Vendor::class);
    // }

    // public function model()
    // {
    //     return $this->belongsTo(AssetModel::class, 'model_id');
    // }
}
