<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = ['name','slug','phone','phone_display','email','address','working_hours','is_active','sort'];
    protected $casts = ['is_active' => 'boolean'];
    public function scopeActive($query) { return $query->where('is_active', true)->orderBy('sort'); }
}
