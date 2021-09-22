<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;


class User extends Authenticatable
{
    use Notifiable, SoftDeletes, Impersonate;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function isAllowedDashboardAccess()
    {
        if ($this->type == "Administrator" || $this->type == "Booster") {
            return true;
        }
        return false;
    }

    public function hasAccessToOrder($orderID)
    {
        $order = Order::query()->where('order', $orderID)->firstOrFail();
        return $order->booster_id == $this->id;
    }
}
