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

    public function scopeLatestBooks(Builder $query) : Builder
    {
        return $query->withCount('reviews')
                    ->withAvg('reviews', 'rating')
                    ->latest();
    }



    public function scopeHighestRated(Builder $query, $from = null, $to = null) : Builder
    {
        return $query->withAvg('reviews', 'rating')
                    ->where(fn(Builder $q) => $this->dateFilter($q, $from, $to))
                    ->orderBy('reviews_avg_rating', 'desc');
    }

    public function scopeMinReviews(Builder $query, int $min) : Builder
    {
        return $query->having('reviews_count','>', $min);
    }

    public function scopePopularLastMonth(Builder $query) : Builder
    {
        return $query->popular(now()->subMonth(), now())
                    ->highestRated(now()->subMonth(), now())
                    ->minReviews(2);
    }

    public function scopePopularLast6Months(Builder $query) : Builder
    {
        return $query->popular(now()->subMonths(6), now())
                    ->highestRated(now()->subMonths(6), now())
                    ->minReviews(5);
    }

    public function scopeHighestRatedLastMonth(Builder $query) : Builder
    {
        return $query->highestRated(now()->subMonth(), now())
                     ->popular(now()->subMonth(), now())
                     ->minReviews(2);
    }

    public function scopeHighestRatedLast6Months(Builder $query) : Builder
    {
        return $query->highestRated(now()->subMonths(6), now())
                     ->popular(now()->subMonths(6), now())
                     ->minReviews(5);
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