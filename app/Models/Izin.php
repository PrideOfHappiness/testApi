<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    use HasFactory;
    protected $table = 'izin';
    protected $primaryKey = 'izinID';
    protected $fillable = [
        'userID',
        'judul',
        'isi',
        'detail',
        'status',
        'komentar',
    ];

    public function getUserID(){
        return $this->belongsTo(User::class, 'userID', 'userID');
    }
}
