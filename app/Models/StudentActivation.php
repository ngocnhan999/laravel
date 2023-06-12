<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Str;


class StudentActivation extends Model
{
    protected $table = 'student_activations';

    protected function getToken()
    {
        return hash_hmac('sha256', Str::random(40), config('app.key'));
    }

    public function createActivation($user)
    {

        $activation = $this->getActivation($user);

        if (!$activation) {
            return $this->createToken($user);
        }
        return $this->regenerateToken($user);

    }

    private function regenerateToken($user)
    {

        $token = $this->getToken();
        StudentActivation::where('user_id', $user->id)->update([
            'token' => $token,
            'created_at' => new Carbon()
        ]);
        return $token;
    }

    private function createToken($user)
    {
        $token = $this->getToken();
        StudentActivation::insert([
            'user_id' => $user->id,
            'token' => $token,
            'created_at' => new Carbon()
        ]);
        return $token;
    }

    public function getActivation($user)
    {
        return StudentActivation::where('user_id', $user->id)->first();
    }

    public function getActivationByToken($token)
    {
        return StudentActivation::where('token', $token)->first();
    }

    public function deleteActivation($token)
    {
        StudentActivation::where('token', $token)->delete();
    }
}
