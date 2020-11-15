<?php
namespace App\Filters;

class VendorFilters extends QueryFilter
{
  public  function category_id($categoryId)
  {
    return $this->builder->where('category_id',$categoryId);
  }
  public  function name($name)
  {
    return $this->builder
           ->join('users', 'user_id', '=', 'users.id')
           ->where('users.name','=',$name);
  }
  public  function rate($rate)
  {
    return $this->builder
    ->where('rating','>=',$rate);
  }
}
