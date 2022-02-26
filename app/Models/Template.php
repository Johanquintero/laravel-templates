<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TemplateType;

class Template extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'template_type_id',
        'user_store_name',
        'user_store_identification',
        'store_name',
        'store_city',
        'store_address',
        'store_operation_center',
        'date',
        'observation',
        'initial_invoice',
        'final_invoice',
        'total_sales',
        'total_iva',
        'total_ipc',
        'total_bag_tax',
        'url_images',
        'total_delivery',
        'value',
    ];

    public function templateType() {
        return $this->belongsTo('App\Models\TemplateType');
    }
}
