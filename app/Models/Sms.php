<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sms extends Model
{
    use HasFactory;

    public function return_typeID ()
    {
        $query = DB::table('campaigns_type')
                ->get();

            return $query;
    }

}
