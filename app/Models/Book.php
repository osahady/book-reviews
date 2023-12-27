<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [ 'title', 'author'];


   public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function scopeTitle(Builder $query, string $title) : Builder
    {
        return $query->where('title', 'like', '%' . $title . '%');
    }

    public function scopePopular(Builder $query, $from = null, $to = null) : Builder
    {
        return $query->withCount('reviews')
                    ->where(fn(Builder $q) => $this->dateFilter($q, $from, $to))
                    ->orderBy('reviews_count', 'desc');
    }



    public function scopeHighestRated(Builder $query, $from = null, $to = null) : Builder
    {
        return $query->withAvg('reviews', 'rating')
                    ->where(fn($q) => $this->dateFilter($q, $from, $to))
                    ->orderBy('reviews_avg_rating', 'desc');
    }

    private function dateFilter(Builder $query, $from = null, $to = null)
    {
        if($from && $to){
            $query->whereBetween('created_at', [$from, $to]);
        }elseif($from && !$to){
            $query->where('created_at', '>=', $from);
        }elseif(!$from && $to){
            $query->where('created_at', '<=', $to);
        }
        return $query;
    }
}
