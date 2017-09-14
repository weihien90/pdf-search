<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Laravel\Scout\Searchable;

class File extends Model
{
    use Searchable;

    /**
     * Get the user that uploads the file
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
