<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Requests extends Model
{
    use HasFactory,Notifiable;
    protected $guarded=[];

    public function item(){
        return $this->belongsTo('App\Models\TrainingPage','training');
    }
}
