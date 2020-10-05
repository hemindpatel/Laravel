<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 05-Oct-20
 * Time: 9:44 AM
 */

namespace App\Scope;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class PostCountScope implements Scope
{
    /**
     * @param Builder $builder
     * @param Model $model
     */
    public function apply(Builder $builder, Model $model){
        $builder->where('count', '>', 6);
    }
}