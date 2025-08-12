<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    public function materials()
    {
        return $this->hasMany(Material::class);
    }

    // Tambahkan relasi ini
    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}