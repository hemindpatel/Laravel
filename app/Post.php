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

    public function scopeGetPostData($query){
        return $query->where('id', '<', 3);
    }

    public function scopeGetDynamicPostData($query, $id){
        return $query->where('id', $id);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * Use : relationship handle
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    public static function getPost($data){
        if(isset($data) && isset($data['id']) && $data['id']){
            $post = self::getDynamicPostData($data['id'])->get();
            if(!$post) {
                return false;
            }
        } else {
            $post = self::getPostData()->orderBy('id', 'desc')->get();
        }
        return $post;
    }
}
