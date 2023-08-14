<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    // Specificăm că modelul nu are timestamps (dacă nu dorești să folosești created_at și updated_at)
    // public $timestamps = false;

    // Specificăm câmpurile care pot fi atribuite în masă (în mod direct de la cereri HTTP)
    protected $fillable = [
        'post_id',
        'reported_by',
        'post_owner',
        'reason'
    ];

    // Relația cu postarea care a fost raportată
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    // Relația cu utilizatorul care a raportat postarea
    public function reporter()
    {
        return $this->belongsTo(User::class, 'reported_by');
    }

    // Relația cu proprietarul postării raportate
    public function postOwner()
    {
        return $this->belongsTo(User::class, 'post_owner');
    }
}
