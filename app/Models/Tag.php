<?php

namespace App\Models;

use App\Contracts\Models\ModelContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static pluck(string $string, string $string1)
 */
class Tag extends BaseModel implements ModelContract
{
    protected $fillable = [
        'slug',
        'title',
    ];

    use HasFactory;

    /**
     * @return BelongsToMany
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'posts_has_tags', 'tag_id', 'post_id');
    }
}
