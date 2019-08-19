<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckList extends Model
{

    public function user()
    {
        return $this->belongsTo("App\User");
    }

    public function items()
    {
        return $this->hasMany("App\CheckListItem","check_list_id");
    }
}
