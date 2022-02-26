<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'template_id',
        'sale_type_id',
        'type_cards',
        'invoice',
        'order_number',
        'advance',
        'previous_cost',
        'cancelation',
        'client_identification',
        'client_phone_number',
        'client_name',
        'client_address',
        'value'
    ];

    public function saleType() {
        return $this->belongsTo('App\Models\SaleType');
    }

}