<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectToGoogle()
    {
        try {
            return Socialite::driver('google')->redirect();
        } catch (\Exception $e) {
            Log::error('Google OAuth redirect failed: ' . $e->getMessage());
            return redirect('/')->with('error', 'เกิดข้อผิดพลาดในการเชื่อมต่อ Google: ' . $e->getMessage());
        }
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // บันทึกข้อมูลผู้ใช้ลง users table
            $user = User::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'email_verified_at' => now(),
                ]
            );
            
            // เก็บข้อมูลผู้ใช้ใน Session
            session(['user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $googleUser->getAvatar(),
            ]]);
            
            // ล็อกอินผู้ใช้
            Auth::login($user);

            Log::info('User logged in: ' . $user->email);

            return redirect('/')->with('success', 'เข้าสู่ระบบสำเร็จ');
        } catch (\Exception $e) {
            Log::error('Google OAuth callback failed: ' . $e->getMessage());
            return redirect('/')->with('error', 'เกิดข้อผิดพลาด: ' . $e->getMessage());
        }
    }

    public function logout()
    {
        $userEmail = session('user')['email'] ?? 'unknown';
        
        session()->forget('user');
        Auth::logout();
        
        Log::info('User logged out: ' . $userEmail);

        return redirect('/')->with('success', 'ออกจากระบบสำเร็จ');
    }
}