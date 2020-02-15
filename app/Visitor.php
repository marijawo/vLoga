<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    // Scopes
    public function scopeActiveVisitors($query) {
        $query->where('time_out', null);
    }

    public function scopeInActiveVisitors($query) {
        $query->where('time_out' != null);
    }


    // default eager-loading
//    protected $with = ['nationality', 'document_type'];

    protected $guarded = [];

    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }

    public function document_type()
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function visitor_card()
    {
        return $this->belongsTo(VisitorCard::class);
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function institution() {
        return $this->belongsTo(Institution::class);
    }

}
