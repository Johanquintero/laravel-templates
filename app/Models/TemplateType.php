<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Template;

class TemplateType extends Model
{
    use HasFactory;

    protected $fillable = ['id','name', 'description'];

    public function template() {
        return $this->belongsTo('App\Models\Template');
    }
}

