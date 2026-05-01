<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // เก็บข้อมูลผู้ใช้ใน Session
            session(['user' => [
                'id' => $googleUser->getId(),
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'avatar' => $googleUser->getAvatar(),
            ]]);

            return redirect('/')->with('success', 'เข้าสู่ระบบสำเร็จ');
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'เกิดข้อผิดพลาด: ' . $e->getMessage());
        }
    }

    public function logout()
    {
        session()->forget('user');
        Auth::logout();

        return redirect('/')->with('success', 'ออกจากระบบสำเร็จ');
    }
}