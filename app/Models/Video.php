<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['title','youtube_id','preview','is_active','sort'];
    protected $casts = ['is_active' => 'boolean'];
    public function scopeActive($query) { return $query->where('is_active', true)->orderBy('sort'); }
    public function getEmbedUrlAttribute(): string { return 'https://www.youtube.com/embed/' . $this->youtube_id; }
    public function getThumbnailAttribute(): string { return $this->preview ?: 'https://img.youtube.com/vi/' . $this->youtube_id . '/hqdefault.jpg'; }
}
