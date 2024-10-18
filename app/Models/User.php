<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Jobs\SendEmailVerificationEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    


    public function sendEmailVerificationNotification() {
        $verification_link = URL::temporarySignedRoute(
            'verification.verify', // The name of your route 
            now()->addMinutes(60), // Expiration time
            [
                'id' => $this->id, // User ID
                'hash' => sha1($this->getEmailForVerification()), // Hash of the email
            ]
        );
        dispatch(new SendEmailVerificationEmail($verification_link, 'khalafnasirov@gmail.com'));
    }

    public function hasVerifiedEmail() {

        return $this->email_verified_at !== null;
    }

    public function markEmailAsVerified() {
        return $this->update([
            'email_verified_at'=>Carbon::now('Asia/Baku'),
        ]);
    }

    public function getEmailForVerification() {
        return $this->email;
    }

    public function getKey() {
        return $this->id;
    }
}
