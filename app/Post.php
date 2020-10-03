<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use Searchable;

    protected $table = 'post';

    protected $fillable = [
        'key_name', 'key_value', 'user_id',
    ];

    public function searchableAs()
    {
        return 'key_name';
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();
        // Customize array...
        return $array;
    }

    //override primary key
    public function getScoutKey()
    {
        return $this->key_name;
    }

    protected $with = ['user'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * Use : relationship handle
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
