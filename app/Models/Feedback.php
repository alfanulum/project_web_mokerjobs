<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedback'; // Nama tabel di database

    protected $fillable = ['name', 'email', 'message']; // Kolom yang bisa diisi otomatis
}
