<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $table = 'portfolio';

    protected $fillable = ['title','slug','category','content','excerpt','image','is_active','sort'];
    protected $casts = ['is_active' => 'boolean'];
    public function scopeActive($query) { return $query->where('is_active', true)->orderBy('sort'); }
}
