<?php

namespace App\Http\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * 用户信息
 * Class User
 *
 * @package App\Http\Models
 * @property mixed $balance
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Models\UserLabel[] $label
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \App\Http\Models\Package $package
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Models\Payment[] $payment
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read \App\Http\Models\User $referral
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\User role($roles)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'user';
    protected $primaryKey = 'id';

    function payment()
    {
        return $this->hasMany(Payment::class, 'user_id', 'id');
    }

    function label()
    {
        return $this->hasMany(UserLabel::class, 'user_id', 'id');
    }

    function referral()
    {
        return $this->hasOne(User::class, 'id', 'referral_uid');
    }

    function getBalanceAttribute($value)
    {
        return $value / 100;
    }

    function setBalanceAttribute($value)
    {
        return $this->attributes['balance'] = $value * 100;
    }
}