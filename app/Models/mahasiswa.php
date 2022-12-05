<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class mahasiswa extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nim',
        'nama',
        'angkatan',
        'password',
        'prodiId',
        'token'
    ];

    public $primaryKey = "nim";
    public $incrementing = false;
    public $keyType = 'string';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        'password',
    ];

    public function prodi()
    {
        return $this->belongsTo(prodi::class, 'prodiId');
    }


    public function matakuliah()
    {
        return $this->belongsToMany(matakuliah::class, 'mahasiswa_matakuliah', 'mhsNim', 'mkId');
    }
}
