<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itempajak extends Model
{
    use HasFactory;
 
    protected $guarded = ['id'];
    protected $with = ['pajak'];

    public function pajak()
    {
    	return $this->belongsTo(Pajak::class)->selectRaw('id,name,rate');
    }

}
