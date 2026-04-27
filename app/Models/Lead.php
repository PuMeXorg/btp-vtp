<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = ['name','phone','email','comment','region','source_url','form_type','status','bitrix24_lead_id'];
}
