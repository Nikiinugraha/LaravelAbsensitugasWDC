<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\PresenceDetail;

class Presence extends Model
{
    protected $fillable = ['nama_kegiatan', 'slug' , 'tgl_kegiatan'];

    /**
     * Get the presence details for the presence.
     */
    public function presenceDetails(): HasMany
    {
        return $this->hasMany(PresenceDetail::class);
    }
}
