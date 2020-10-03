<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $table = 'agent';

    protected $fillable = [
        'name',
    ];

    public function address(){
        return $this->morphOne('APP\Address', 'addressable');
    }

    /**
     * @param $data
     * @return bool|mixed
     * Use : used to add agent data using morph relationship
     */
    public static function addAgent($data){
        $agent = new self();
        $agent->name = (isset($data['name']) && $data['name']) ? $data['name'] : NULL;
        if($agent->save()){
            $address = new Address();
            $address->address = (isset($data['address']) && $data['address']) ? $data['address'] : NULL;
            $agent->address()->save($address);
            return $agent->id;
        }
        return false;
    }
}
