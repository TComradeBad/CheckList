<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckListItem extends Model
{
    public function checkList()
    {
        return $this->belongsTo("App\CheckList","id");
    }
}
