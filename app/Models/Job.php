<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    /** @use HasFactory<\Database\Factories\JobFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'salary',
        'salary_min',
        'salary_max',
        'location',
        'schedule',
        'url',
        'featured',
    ];

    public function tag(string $name)
    {
     $tag =Tag::firstOrCreate(['name'=>$name]);  
     $this->tags()->attach($tag);
     return $tag;
    }

    public function getSalaryAttribute(?string $value): string
    {
        if ($value) {
            return $value;
        }

        if ($this->salary_min && $this->salary_max) {
            return $this->salary_min === $this->salary_max
                ? 'Ksh ' . number_format($this->salary_min)
                : 'Ksh ' . number_format($this->salary_min) . ' - ' . number_format($this->salary_max);
        }

        return 'Salary not specified';
    }
      public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

     public function employer()
    {
        return $this->belongsTo(Employer::class);       
    }
  
   
}
