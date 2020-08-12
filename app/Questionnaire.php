<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * Class Questionnaire
 *
 * Collection of questions
 *
 * @package App
 */
class Questionnaire extends Model
{
    protected $guarded = [];

    //helper method
    //full path..
    /**
     * @return string
     */
    public function path(): string
    {
        return url('/questionnaires/' . $this->id);
    }

    /**
     * @return string
     */
    public function publicPath(): string
    {
        return url('/surveys/' . $this->id .'-'. Str::slug($this->title));
    }

    /**
     * Questionnaire got a user.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    /**
     * @return HasMany
     */
    public function surveys(): HasMany
    {
        return $this->hasMany(Survey::class);
    }
}
