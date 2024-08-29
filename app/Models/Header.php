<?php

namespace App\Models;

use App\Http\Controllers\Api\ProductController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    use HasFactory;
     
    protected $fillable = [
        'event_title',
        'welcome_text',
        'cover_overview',
        'cover_header',
        'event_start_date',
        'user_id',
        'product_id',
        'theme_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function message()
    {
        return $this->hasMany(Message::class);
    }
    
    public function location()
    {
        return $this->hasMany(Location::class);
    }
    
    public function organizer()
    {
        return $this->hasMany(Organizer::class);
    }

    public function event()
    {
        return $this->hasMany(Event::class);
    }

    public function gallery()
    {
        return $this->hasMany(Gallery::class);
    }
}
