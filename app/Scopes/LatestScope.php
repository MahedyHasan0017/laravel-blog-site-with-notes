<?php 

namespace App\Scopes ;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class LatestScope implements Scope{
    public function apply(Builder $builder , Model $model){
        $builder->orderBy('created_at','desc') ; //this will work for BlogPost model 

        // $builder->orderBy($model::CREATED_AT,'desc') ; //this will work for every model
    }
}