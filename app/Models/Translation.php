<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'word',
        'translation',
        'locale_id',
        'tag_id'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */
    public function locale()
    {
        return $this->belongsTo(Locale::class, 'locale_id');
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class, 'tag_id');
    }
}
