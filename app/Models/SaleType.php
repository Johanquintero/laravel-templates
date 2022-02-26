<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleType extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];


    public function templateDetail() {
        return $this->belongsTo('App\Models\TemplateDetail');
    }

}
