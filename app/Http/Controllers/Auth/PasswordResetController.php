<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordResetCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    /**
     * Tampilkan form untuk request reset password
     */
    public function showRequestForm()
    {
        return view('auth.passwords.request');
    }

    /**
     * Kirim kode verifikasi ke email
     */
    public function sendCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'Email tidak ditemukan dalam database kami.',
        ]);

        // Generate kode verifikasi (6 digit)
        $code = sprintf("%06d", mt_rand(1, 999999));
        
        // Simpan kode ke database
        PasswordResetCode::where('email', $request->email)->delete(); // Hapus kode lama
        PasswordResetCode::create([
            'email' => $request->email,
            'code' => $code,
        ]);
        
        // Kirim kode ke email
        $this->sendResetCodeEmail($request->email, $code);
        
        return redirect()->route('password.verify')
                         ->with('email', $request->email)
                         ->with('status', 'Kode verifikasi telah dikirim ke email Anda!');
    }
    
    /**
     * Tampilkan form untuk verifikasi kode
     */
    public function showVerifyForm()
    {
        if (!session('email')) {
            return redirect()->route('password.request');
        }
        
        return view('auth.passwords.verify');
    }
    
    /**
     * Verifikasi kode dan tampilkan form reset password
     */
    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'code' => 'required|digits:6',
        ]);
        
        // Cek kode verifikasi
        $resetCode = PasswordResetCode::where('email', $request->email)
                                      ->where('code', $request->code)
                                      ->first();
        
        if (!$resetCode) {
            return back()->withErrors(['code' => 'Kode verifikasi tidak valid.']);
        }
        
        // Cek apakah kode sudah expired (15 menit)
        if (now()->diffInMinutes($resetCode->created_at) > 15) {
            $resetCode->delete();
            return back()->withErrors(['code' => 'Kode verifikasi sudah kadaluarsa. Silakan request kode baru.']);
        }
        
        return redirect()->route('password.reset.form')
                         ->with('email', $request->email)
                         ->with('code_verified', true);
    }
    
    /**
     * Tampilkan form reset password
     */
    public function showResetForm()
    {
        if (!session('email') || !session('code_verified')) {
            return redirect()->route('password.request');
        }
        
        return view('auth.passwords.reset');
    }
    
    /**
     * Reset password
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
        ]);
        
        if (!session('code_verified')) {
            return redirect()->route('password.request');
        }
        
        // Update password
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->setRememberToken(Str::random(60));
        $user->save();
        
        // Hapus kode verifikasi
        PasswordResetCode::where('email', $request->email)->delete();
        
        return redirect()->route('login')
                         ->with('status', 'Password Anda berhasil direset! Silakan login dengan password baru.');
    }
    
    /**
     * Kirim email dengan kode verifikasi
     */
    private function sendResetCodeEmail($email, $code)
    {
        $user = User::where('email', $email)->first();
        
        Mail::send('emails.reset-code', ['user' => $user, 'code' => $code], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Kode Reset Password');
        });
    }
}