<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Item extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];
    protected $with = ['kategori','itempajak'];

    public function scopeFilter($query, array $filters)
    {

    	$query->when($filters['search'] ?? false, function($query, $search){
    		return $query->where('name', 'like', '%'.$search.'%');
    	});

    	$query->when($filters['kategori'] ?? false, function($query, $kategori){
    		return $query->whereHas('kategori', function($query) use($kategori) {
    			$query->where('slug', $kategori);
    		});
    	});
    }


    public function kategori()
    {
    	return $this->belongsTo(Kategori::class)->selectRaw('id,name,slug');
    }

    public function itempajak()
    {
    	return $this->hasMany(Itempajak::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getitems()
    {
    	return $this->belongsTo(Kategori::class);
    }
}
