<?php

namespace App\Models;

use App\Contracts\Models\ModelContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static pluck(string $string, string $string1)
 */
class Category extends BaseModel implements ModelContract
{
    protected $fillable = [
        'slug',
        'title',
        'preview_text',
    ];

    use HasFactory;

    /**
     * @return HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'category_id', 'id');
    }
}
