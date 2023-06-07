<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    protected $fillable = ['social_media_name', 'username', 'customer_id'];

    public function employee()
    {
        return $this->belongsTo(Customer::class);
    }
}
