<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Hotel extends Model {
    protected $fillable = ['name','location','description','rating','image'];
    public function rooms(){ return $this->hasMany(Room::class); }

    // Scopes
    public function scopeLocation(Builder $q, $loc){ return $loc? $q->where('location','like',"%$loc%") : $q; }
    public function scopeWithPriceBetween(Builder $q,$min,$max){
        if($min===null && $max===null) return $q;
        return $q->whereHas('rooms', function($rq) use($min,$max){
            if($min!==null) $rq->where('price','>=',$min);
            if($max!==null) $rq->where('price','<=',$max);
        });
    }
    public function scopeMinRating(Builder $q,$min){ return $min!==null? $q->where('rating','>=',$min) : $q; }
}
