<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrafficLight extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_persimpangan',
        'latitude',
        'longitude',
        'cctv_url',
        'status',
        'durasi_merah',
        'durasi_kuning',
        'durasi_hijau',
        'mode',
        'last_changed_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'last_changed_at' => 'datetime',
        ];
    }
}
