<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
//use Laravel\Scout\Searchable;
use TCG\Voyager\Models\Post as VoyagerPost;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property int $author_id
 * @property int|null $category_id
 * @property string $title
 * @property string|null $seo_title
 * @property string|null $excerpt
 * @property string $body
 * @property string|null $image
 * @property string $slug
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 * @property string $status
 * @property int $featured
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \TCG\Voyager\Models\User|null $authorId
 * @property-read \TCG\Voyager\Models\Category|null $category
 * @property-read null $translated
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \TCG\Voyager\Models\Translation> $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post published()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereExcerpt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereSeoTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTranslation(string $field, string $operator, string $value = null, string $locales = null, string $default = true)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post withTranslation($locale = null, $fallback = true)
 * @method static \Illuminate\Database\Eloquent\Builder|Post withTranslations($locales = null, $fallback = true)
 * @property string|null $schema
 * @property int|null $top_nudge_id
 * @property int|null $bottom_nudge_id
 * @property int $read_count
 * @property-read \App\Models\User|null $author
 * @property-read \App\Models\Nudge|null $bottom_nudge
 * @property-read \App\Models\Nudge|null $top_nudge
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereBottomNudgeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereReadCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereSchema($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTopNudgeId($value)
 * @mixin \Eloquent
 */
class Post extends VoyagerPost
{
//    use HasFactory, Searchable;
    use HasFactory;

    function top_nudge(): BelongsTo
    {
        return $this->belongsTo(Nudge::class, 'top_nudge_id');
    }

    function bottom_nudge(): BelongsTo
    {
        return $this->belongsTo(Nudge::class, 'bottom_nudge_id');
    }

    function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
