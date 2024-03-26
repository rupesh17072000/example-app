<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\SendAppointmentNotification;
use App\Http\Resources\AppointmentResource;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Doctor;


class AppointmentController extends Controller
{
    
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
        ]);

        // Check if appointment already exists for the same date and time
        $existingAppointment = Appointment::where('appointment_date', $request->appointment_date)
            ->where('appointment_time', $request->appointment_time)
            ->first();

        if ($existingAppointment) {
            return response()->json(['message' => 'Appointment already exists for this date and time.'], 400);
        }

        // Create the appointment (status set to RSVP by default)
        $appointment = Appointment::create([
            'patient_id' => $request->patient_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'status' => 'RSVP',
        ]);

        // Dispatch job to send appointment notification
        SendAppointmentNotification::dispatch($appointment);

        return new AppointmentResource($appointment);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:cancel,reject,postpone',
        ]);

        $appointment = Appointment::findOrFail($id);
        $appointment->status = $request->status;
        $appointment->save();

        return new AppointmentResource($appointment);
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $appointments = Appointment::where('patient_id', $user->id)
            ->when($request->has('daappointment_datete'), function ($query) use ($request) {
                $query->whereDate('appointment_date', $request->appointment_date);
            })
            ->get();
        return AppointmentResource::collection($appointments);
    }
}
