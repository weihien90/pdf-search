<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Laravel\Scout\Searchable;

class File extends Model
{
    use Searchable;

    /**
     * Scope a query to only retrieve part of the extracted text.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSubContent($query, $length)
    {
        return $query->select( DB::raw("id, name, description, LEFT(content, {$length}) as content") );
    }

    /**
     * Get the user that uploads the file
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
