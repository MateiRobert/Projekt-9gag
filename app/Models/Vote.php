<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    // Spune Laravel să nu protejeze câmpurile
    // (dacă folosești atribuirea în masă, altfel poți să-l omiți sau să setezi direct câmpurile pe care dorești să le atribui)
    protected $guarded = [];

    /**
     * Un vot aparține unui user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Un vot este dat pentru o postare.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
