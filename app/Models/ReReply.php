<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReReply extends Model
{
    use HasFactory;

            /**
     * The table associated with model
     */
    protected $table = 're_replies';

    /**
     * The attributes that are mass assignable
     * @var array
     */
    protected $fillable = [
        'user_id', 'username', 'username_to', 'comment_id', 'reply_id', 'reply', 'hall_id', 'hall_name'
    ];

    /**
     * The relationship model
     */
    public function user()
    {
        $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function reply()
    {
        $this->belongsTo(Reply::class, 'reply_id', 'id');
    }

    public function hall()
    {
        $this->belongsTo(Hall::class, 'hall_id', 'id');
    }
}
