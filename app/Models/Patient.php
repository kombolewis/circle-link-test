<?php

namespace App\Models;

use App\Models\BPO;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;


    protected $guarded = [];

    public function bpos(){
        return $this->hasMany(BPO::class);
    }
}
