<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $guarded = [];

 public function institution() {

  return $this->belongsTo(Institution::class);
 }
}
