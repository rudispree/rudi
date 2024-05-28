<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Karyawan extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $tabel = "karyawans";
    protected $primaryKey = "nik";
    public $timestamps = false;
    
    protected $fillable = [
        'nik',
        'nama_lengkap',
        'jabatan',
        'foto',
        'no_hp',
        'kode_dept',
        'password',
    ];

   
    protected $hidden = [
        'password',
        'remember_token',
    ];

   
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public static function getAllKaryawan() {
    //     $result = DB::table('karyawans')
    //     ->select('nik','nama_lengkap','jabatan','no_hp','password','foto')
    //     ->get()->toArray();
    //     return $result;
    // }
}
