
<?php

use Illuminate\Http\Resources\Json\JsonResource;
class AppointmentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'patient_id' => $this->patient_id,
            'date' => $this->date,
            'time' => $this->time,
            'status' => $this->status,
        ];
    }
}