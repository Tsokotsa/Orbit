<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;

    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getFullNameAttribute() {
        return "{$this->name} {$this->surname}";
    }

    public function getAvatarPathAttribute() {
        return json_decode($this->avatar, true);
    }

    public function validatePassword ($request)                                                                                                                                             
    {                                                                                                                                                                                       
        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {                                                                                                    
            return response()->json(['message' => 'Current Password do not match our records!'], 500);                                                                                          
        }                                                                                                                                                                                   
                                                                                                                                                                                            
        if (strcmp($request->get('current_password'), $request->get('new_password')) == 0) {                                                                                                
            return response()->json(['message' => 'You can not use the same password as the existing!'], 500);                                                                                  
        }                                                                                                                                                                                   
                                                                                                                                                                                            
        if (strcmp($request->get('confirm_password'), $request->get('new_password')) !== 0) {                                                                                                
            return response()->json(['message' => 'Entered Password Do not Match!'], 500);                                                                                                      
        }                                                                                                                                                                                   
                                                                                                                                                                                            
        return 'AG';                                                                                                                                                                        
    } 
}
