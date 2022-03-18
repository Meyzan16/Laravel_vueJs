<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'inscurance_price',
        'shipping_price',
        'transaction_status',
        'total_price',
        'kode_transaction'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function user()
    {                                      
        //ditambahkan id di belakang
        return $this->belongsTo(User::class, 'users_id' , 'id');
    }

}
