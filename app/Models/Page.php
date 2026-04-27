<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['title','slug','type','parent_id','content','excerpt','image','meta_title','meta_description','is_active','sort'];
    protected $casts = ['is_active' => 'boolean'];

    public function parent() { return $this->belongsTo(Page::class, 'parent_id'); }
    public function children() { return $this->hasMany(Page::class, 'parent_id')->where('is_active', true)->orderBy('sort'); }
    public function scopeActive($query) { return $query->where('is_active', true); }
    public function getUrlAttribute(): string {
        return match($this->type) {
            'service' => '/uslugi/' . $this->slug,
            'catalog' => '/catalog/' . $this->slug,
            default   => '/' . $this->slug,
        };
    }
}
