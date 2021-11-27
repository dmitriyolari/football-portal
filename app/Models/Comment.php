<?php

namespace App\Models;

use App\Contracts\Models\ModelContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed $user_id
 */
class Comment extends BaseModel implements ModelContract
{
    protected $fillable = [
        'user_id',
        'text',
    ];

    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, "parent_id", "id");
    }

    /**
     * @return BelongsTo
     */
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id");
    }

    /**
     * @return BelongsTo
     */
    public function posts(): BelongsTo
    {
        return $this->belongsTo(Post::class, "post_id");
    }
}
