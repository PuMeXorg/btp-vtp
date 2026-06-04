<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['title','youtube_id','preview','platform','is_active','sort'];
    protected $casts = ['is_active' => 'boolean'];
    public function scopeActive($query) { return $query->where('is_active', true)->orderBy('sort'); }
    public function getEmbedUrlAttribute(): string
    {
        return match($this->platform ?? 'youtube') {
            'rutube' => 'https://rutube.ru/play/embed/' . $this->youtube_id,
            default  => 'https://www.youtube.com/embed/' . $this->youtube_id,
        };
    }
    public function getThumbnailAttribute(): string
    {
        if ($this->preview) return $this->preview;
        return match($this->platform ?? 'youtube') {
            'rutube' => '/public/images/logo-ik-icon.png',
            default  => 'https://img.youtube.com/vi/' . $this->youtube_id . '/hqdefault.jpg',
        };
    }
}
