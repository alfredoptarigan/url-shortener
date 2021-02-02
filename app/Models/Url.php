<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Url extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $casts = [
        'deleted_at' => 'datetime:Y-m-d H:m:s',
        'created_at' => 'datetime:Y-m-d H:m:s',
        'updated_at' => 'datetime:Y-m-d H:m:s',
        'expire_at' => 'datetime:Y-m-d H:m:s',
    ];

    protected $table = 'url';
    protected $fillable = ['user_id', 'title', 'url_raw', 'url_convert', 'expire_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
