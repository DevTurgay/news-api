<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * News model class
 */
class News extends Model
{

    use HasFactory;
    use Sluggable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'news';

    /**
     * Get the comments for the news.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Sluggable is being used to generate link based on title
     *
     * @return array
     */
    public function sluggable(): array
    {
        return ['link' => ['source' => 'title']];
    }
}
