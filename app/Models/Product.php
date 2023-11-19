<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'description', 'image_path']; // Define the fillable fields.

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // Add any additional methods or relationships related to products here if needed.

    // For example, you can add a method to get the full URL of the product image.
    public function getImageUrl()
    {
        if ($this->image_path) {
            return asset('storage/' . $this->image_path); // Assuming you're using the 'storage' disk.
        }
        
        // You may want to return a default image URL if no image is set.
        return asset('images/noodles.png');
    }
}
