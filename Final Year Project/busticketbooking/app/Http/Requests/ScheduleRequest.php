<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'bus_id' => 'required|',
            'start_at' => 'required|date|after_or_equal:today',
            'start_destination_id' => 'required|max:50',
            'destination_id' => 'required|max:50',
            'price_schedules' => 'required|numeric|min:10|max:100',
            'notes' => 'required|'
        ];
    }
}
