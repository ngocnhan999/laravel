<?php

namespace App\Http\Controllers;

use App\Repositories\Student\Interfaces\StudentInterface;
use App\Repositories\Mentor\Interfaces\MentorInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{

    /**
     * @var StudentInterface
     */
    protected $studentRepository;

    /**
     * GoogleController constructor.
     *
     * @param StudentInterface $studentRepository
     */
    public function __construct(
        StudentInterface $studentRepository,
        MentorInterface $mentorRepository
    )
    {
        $this->studentRepository = $studentRepository;
        $this->mentorRepository = $mentorRepository;
    }

    public function loginWithGoogleStudent()
    {
        return Socialite::driver('google')->redirect(route('google.callback'));

    }
    public function loginWithGoogleMentor()
    {
        return Socialite::driver('google')->redirect(route('google.callback'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function callbackFromGoogle(Request $request)
    {
        try {
            $previousUrl= $request->session()->previousUrl();
            $user = Socialite::driver('google')->user();

            if(substr($previousUrl, -12) == "google/login"){
                $is_user = $this->studentRepository->getFirstBy([
                    'email' => $user->getEmail()
                ]);
                if (!$is_user) {
                    $student = $this->studentRepository->createOrUpdate([
                        'display_name' => $user->getName(),
                        'email'        => $user->getEmail(),
                        'active'       => true,
                        'confirmed_at' => Carbon::now(config('app.timezone')),
                        'google_id'    => $user->getId(),
                        'password'     => Hash::make($user->getName() . '@' . $user->getId())
                    ]);
                } else {
                    $is_user->fill([
                        'google_id' => $user->getId()
                    ]);
                    $student = $this->studentRepository->createOrUpdate($is_user);
                }
                \auth()->guard('student')->loginUsingId($student->id);
                return redirect()->route('student.app_form')->with('success', 'Thành công!');

            }else{
                $is_user = $this->mentorRepository->getFirstBy([
                    'email' => $user->getEmail()
                ]);
                if (!$is_user) {
                    $mentor = $this->mentorRepository->createOrUpdate([
                        'display_name' => $user->getName(),
                        'email'        => $user->getEmail(),
                        'active'       => true,
                        'confirmed_at' => Carbon::now(config('app.timezone')),
                        'google_id'    => $user->getId(),
                        'password'     => Hash::make($user->getName() . '@' . $user->getId())
                    ]);
                } else {
                    $is_user->fill([
                        'google_id' => $user->getId()
                    ]);
                    $mentor = $this->mentorRepository->createOrUpdate($is_user);
                }
                \auth()->guard('mentor')->loginUsingId($mentor->id);
                return redirect()->route('mentor.app_form')->with('success', 'Thành công!');
            }
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
