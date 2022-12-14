<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class matakuliah extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nama'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [];

    public function mahasiswas()
    {
        return $this->belongsToMany(mahasiswa::class, 'mahasiswa_matakuliah', 'mkId', 'mhsNim');
    }
}