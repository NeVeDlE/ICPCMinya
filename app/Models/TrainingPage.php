<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingPage extends Model
{
    use HasFactory;
    protected $guarded=[];


    protected $casts = [

        'topics' => 'array',
    ];
    public function item(){
        return $this->belongsTo('App\Models\AboutPage','mentor');
    }
}
