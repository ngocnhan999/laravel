<?php
namespace App\Classes;

use Mail;
use App\Models\StudentActivation;
use App\Mail\StudentActivationEmail;
use App\Models\Student;
use App\Models\User;

class ActivationService
{
    protected $resendAfter = 24; // Sẽ gửi lại mã xác thực sau 24h nếu thực hiện sendActivationMail()
    protected $userActivation;

    public function __construct(StudentActivation $userActivation)
    {
        $this->userActivation = $userActivation;
    }

    //gui email
    public function sendActivationMail($user)
    {
        if ($user->activate || !$this->shouldSend($user)) return;
        $token = $this->userActivation->createActivation($user);//save user_activations
        $user->activation_link = route('user.activate', $token);
        $mailable = new StudentActivationEmail($user);
        Mail::to($user->email)->send($mailable);
        
        /* if (Mail::failures() != 0) {
            return "Email has been sent successfully.";
        }else{
            return "Oops! There was some error sending the email.";
        } */
    }

    //thong tin token
    public function activateUser($token)
    {
        $activation = $this->userActivation->getActivationByToken($token);
        if ($activation === null) return null;
        $user = Student::find($activation->user_id);
        $user->active = true;
        $user->save();
        //$this->userActivation->deleteActivation($token);

        return $user;
    }

    private function shouldSend($user)
    {
        $activation = $this->userActivation->getActivation($user);
        return $activation === null || strtotime($activation->created_at) + 60 * 60 * $this->resendAfter < time();
    }

}