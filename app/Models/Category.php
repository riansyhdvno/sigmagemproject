<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //

    public function listCategory()
    {
        return $this->belongsTo(ListCategory::class, 'listcategory_id');
    }


}
