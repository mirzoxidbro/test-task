<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'passport', 'firstname', 'lastname', 'parent_name', 'position', 'phone', 'address', 'company_name'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
