<?php

namespace App\Models\Order;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['playlist_ids', 'order_identifier', 'total'];

    // kira kira guna casts untuk merubah tipedata untuk colom di tabel
    protected $casts = [
        'playlist_ids' => 'array',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
