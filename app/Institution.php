<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Institution extends Model
{
// use softDeletes;


 protected $guarded = [];

 public function scopeOnlyGNPC ($query)
 {
  return $query->where( 'name', 'GNPC' );
 }

 public function scopeOnlyMoPE ($query)
 {
  return $query->where( 'name', 'MoPE' );
 }

 public function scopeOnlyOIC ($query)
 {
  return $query->where( 'name', 'OIC' );
 }

 public function scopeOnlyFAR ($query)
 {
  return $query->where( 'name', 'FAR' );
 }

 /***
  * Dyanmci scoping, provide institute name to filter
  * @param $query
  * @param $name
  * @return mixed
  */
 public function scopeInstituteName($query, $name) {
  return $query->where('name', $name);
 }

 /**
  * @var array
  * Get notifications and handle events
  */
 /*protected $dispatchesEvents = [
  'saved' => InstitutionSaved::class,
  'deleted' => InstitutionDeleted::class
 ];*/

}
