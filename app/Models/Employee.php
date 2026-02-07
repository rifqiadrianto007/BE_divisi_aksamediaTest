<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Employee extends Model
{

    protected $table = 'employees';

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'image',
        'name',
        'phone',
        'division_id',
        'position'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            if (!$model->id) {
                $model->id = (string) Str::uuid();
            }

        });
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

}
