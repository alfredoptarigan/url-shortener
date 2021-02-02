<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Gift;

class ClaimGift extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'claim_gift';
    protected $casts = [
        'deleted_at' => 'datetime:Y-m-d H:m:s',
        'created_at' => 'datetime:Y-m-d H:m:s',
        'updated_at' => 'datetime:Y-m-d H:m:s',
        'claim_at' => 'datetime:Y-m-d H:m:s',
    ];
    protected $fillable = ['gift_name', 'user_id', 'gift_id', 'claim_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gift()
    {
        return $this->belongsTo(Gift::class);
    }
}
