<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckList extends Model
{
    protected $fillable = [
        "name",
        "user_id",
        "done"
    ];

    protected $appends = [
      "items"
    ];
    public function user()
    {
        return $this->belongsTo("App\User");
    }

    public function items()
    {
        return $this->hasMany("App\CheckListItem", "check_list_id");
    }

    public function getItemsAttribute()
    {
        $this->attributes ["items"] = $this->items()->get();
        return $this->attributes ["items"];
    }
}
