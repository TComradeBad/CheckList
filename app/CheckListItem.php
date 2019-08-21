<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckListItem extends Model
{
    protected $fillable = [
        "name",
        "check_list_id",
        "done"
    ];

    public function checkList()
    {
        return $this->belongsTo("App\CheckList", "id");
    }
}
