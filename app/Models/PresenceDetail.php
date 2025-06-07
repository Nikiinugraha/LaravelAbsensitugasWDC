<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PresenceDetail extends Model
{
     protected $fillable = ['presence_id', 'nama', 'absen' , 'kelas', 'tanda_tangan'];
}
