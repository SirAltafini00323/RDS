<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function paniers()
    {
        return $this->hasMany("App\Models\Panier");
    }

    public function isAdmin()
    {
        return $this->admin ==1 ;
    }

    public function panierEnCours()
    {
        $paniers = $this->paniers();
        if($paniers)
            return $paniers->orderByDesc('id')->get()->filter(function($value,$key){
                return !$value->isBuy();
            })->first();
        return null; 

    }


}
