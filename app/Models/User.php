<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'users';
    protected $primaryKey = 'id_user';

    protected $guarded= ['id_user'];
    protected $hidden = [
        'password',
        'remember_token',
    ];

   public function level()
{
    return $this->belongsTo(Level::class, 'level_id');
}
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }
    // Di model User
   /*  public function mahasiswa()
    {
        return $this->hasOne(mhs::class, 'id_user'); // Adjust foreign key if necessary
    } */
    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'user_id', 'id_user');
    }

    public function dosen()
    {
        return $this->hasOne(Dosen::class, 'user_id', 'id_user');
    }

    public function dosens()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen', 'id_dosen');
    }
    // Relasi untuk mahasiswa


}
