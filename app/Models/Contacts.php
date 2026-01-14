<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'email',
        'cell1',
        'cell2',
    ];

    public function setEnableNotificationAttribute($data)                                                                                                                                                                                     
    {                                                                                                                                                                                                                             
        if ($data === 'on'){                                                                                                                                                                                                      
            $this->attributes['enable_notification'] = 'y';                                                                                                                                                                                    
        } else {                                                                                                                                                                                                                  
            $this->attributes['enable_notification'] = 'n';                                                                                                                                                                                    
        }                                                                                                                                                                                                                         
    } 
    
    public function getFullNameAttribute() {
        return "{$this->name} {$this->surname}";
    }
}
