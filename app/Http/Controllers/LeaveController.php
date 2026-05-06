<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LeaveController extends Controller
{
    public function __construct()
    {
        // ไม่ใช้ auth middleware เพราะ custom session auth
    }

    // แสดงรายการขอลา
    public function index()
    {
        $user = User::find(session('user')['id'] ?? null);
        
        if (!$user) {
            return redirect('/')->with('error', 'กรุณาเข้าสู่ระบบ');
        }

        $leaves = Leave::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        $leaveTypes = Leave::getLeaveTypes();
        
        return view('leaves.index', compact('leaves', 'user', 'leaveTypes'));
    }

    // แสดงฟอร์มขอลา
    public function create()
    {
        $user = User::find(session('user')['id'] ?? null);
        
        if (!$user) {
            return redirect('/')->with('error', 'กรุณาเข้าสู่ระบบ');
        }

        $leaveTypes = Leave::getLeaveTypes();
        
        return view('leaves.create', compact('user', 'leaveTypes'));
    }

    // บันทึกการขอลา
    public function store(Request $request)
    {
        $validated = $request->validate([
            'leave_type' => 'required|in:sick,vacation,family,study,other',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'nullable|string|max:500',
        ]);

        $user = User::find(session('user')['id']);
        
        if (!$user) {
            return redirect('/')->with('error', 'กรุณาเข้าสู่ระบบ');
        }

        $startDate = Carbon::parse($validated['start_date']);
        $endDate = Carbon::parse($validated['end_date']);
        $totalDays = $startDate->diffInDays($endDate) + 1;

        Leave::create([
            'user_id' => $user->id,
            'leave_type' => $validated['leave_type'],
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_days' => $totalDays,
            'reason' => $validated['reason'],
            'status' => 'pending',
        ]);

        return redirect()->route('leaves.index')->with('success', 'ส่งขอลาสำเร็จ');
    }

    // แสดงรายละเอียด
    public function show(Leave $leave)
    {
        $user = User::find(session('user')['id']);
        
        if ($user->id !== $leave->user_id && $user->id !== $leave->approved_by) {
            abort(403);
        }

        return view('leaves.show', compact('leave'));
    }

    // แสดงฟอร์มแก้ไข
    public function edit(Leave $leave)
    {
        $user = User::find(session('user')['id']);
        
        if ($user->id !== $leave->user_id || $leave->status !== 'pending') {
            abort(403);
        }

        $leaveTypes = Leave::getLeaveTypes();
        
        return view('leaves.edit', compact('leave', 'user', 'leaveTypes'));
    }

    // อัปเดตการขอลา
    public function update(Request $request, Leave $leave)
    {
        $user = User::find(session('user')['id']);
        
        if ($user->id !== $leave->user_id || $leave->status !== 'pending') {
            abort(403);
        }

        $validated = $request->validate([
            'leave_type' => 'required|in:sick,vacation,family,study,other',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'nullable|string|max:500',
        ]);

        $startDate = Carbon::parse($validated['start_date']);
        $endDate = Carbon::parse($validated['end_date']);
        $totalDays = $startDate->diffInDays($endDate) + 1;

        $leave->update([
            'leave_type' => $validated['leave_type'],
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_days' => $totalDays,
            'reason' => $validated['reason'],
        ]);

        return redirect()->route('leaves.index')->with('success', 'อัปเดตขอลาสำเร็จ');
    }

    // ลบการขอลา
    public function destroy(Leave $leave)
    {
        $user = User::find(session('user')['id']);
        
        if ($user->id !== $leave->user_id || $leave->status !== 'pending') {
            abort(403);
        }

        $leave->delete();

        return redirect()->route('leaves.index')->with('success', 'ลบขอลาสำเร็จ');
    }
}