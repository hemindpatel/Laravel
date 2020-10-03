<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function address(){
        return $this->morphOne(Address::class, 'addressable');
    }

    /**
     * @param $data
     * @return bool|mixed
     * Use : used to add user data using morph relationship
     */
    public static function addUser($data){
        $user = new self();
        $user->name = (isset($data['name']) && $data['name']) ? $data['name'] : NULL;
        $user->email = (isset($data['email']) && $data['email']) ? $data['email'] : NULL;
        $user->password = (isset($data['password']) && $data['password']) ? bcrypt($data['password']) : NULL;
        if($user->save()){
            $address = new Address();
            $address->address = (isset($data['address']) && $data['address']) ? $data['address'] : NULL;
            $user->address()->save($address);
            return $user->id;
        }
        return false;
    }
}
