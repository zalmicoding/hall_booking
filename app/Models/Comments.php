<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

        /**
     * The table associated with model
     */
    protected $table = 'comments';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'username', 'hall_id', 'hall_name','comment',
    ];

    /**
     * The relationship models
     */
    public function user()
    {
        $this->belongsTo(User::class, 'user_id', 'id');

    }

    public function reply()
    {
        return $this->hasMany(Reply::class);
    }

    public function hall()
    {
        $this->belongsTo(Hall::class, 'hall_id', 'id');

    }
}
