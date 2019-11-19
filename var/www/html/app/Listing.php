<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    protected $table = 'listing';

    public function getSubmitBy()
    {
        return $this->belongsTo('App\User', 'submitter_id', 'id')->value('name');
    }
}
