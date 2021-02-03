<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ClaimGift;

class Gift extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'gift';
    protected $casts = [
        'deleted_at' => 'datetime:Y-m-d H:m:s',
        'created_at' => 'datetime:Y-m-d H:m:s',
        'updated_at' => 'datetime:Y-m-d H:m:s',
        'expire_at' => 'datetime:Y-m-d H:m:s',
    ];
    protected $fillable = ['user_id', 'title', 'unique_key', 'description', 'expire_at', 'type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function claimgift()
    {
        return $this->hasMany(ClaimGift::class);
    }
}
