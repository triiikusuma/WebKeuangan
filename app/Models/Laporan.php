<?php

// app/Models/Laporan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan';

    protected $fillable = [
        'jenisLaporan', 
        'buktiLaporan', 
        'keterangan', 
        'status', 
        'balasanAdmin', 
        'user_id'
    ];

    // Define the inverse relationship with user (belongsTo)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            $words = explode(' ', $search); // Split search input into words
    
            foreach ($words as $word) {
                $query->where(function($q) use ($word) {
                    $q->where('jenisLaporan', 'like', '%' . $word . '%')
                      ->orWhere('status', 'like', '%' . $word . '%')
                      ->orWhere('keterangan', 'like', '%' . $word . '%')
                      ->orWhere('balasanAdmin', 'like', '%' . $word . '%');
                });
            }
        }
    
        return $query;
    }
}
