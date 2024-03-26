<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Doctor;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $appointments = Appointment::where('doctor_id', $user->id)
            ->when($request->has('date'), function ($query) use ($request) {
                $query->whereDate('date', $request->date);
            })
            ->get();
        return response()->json(['appointments' => $appointments]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:cancel,reject,approve',
        ]);
        $appointment = Appointment::findOrFail($id);
        $appointment->status = $request->status;
        $appointment->save();
        return response()->json(['message' => 'Appointment status updated successfully.', 'appointment' => $appointment]);
    }
}
