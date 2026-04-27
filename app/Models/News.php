<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['title','slug','content','excerpt','image','meta_title','meta_description','is_active','published_at'];
    protected $casts = ['is_active' => 'boolean', 'published_at' => 'datetime'];
    public function scopeActive($query) { return $query->where('is_active', true)->orderByDesc('published_at'); }
}
