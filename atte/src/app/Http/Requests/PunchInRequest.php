<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Stamp;

class PunchInRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $user = Auth::user();
            $existingStamp = Stamp::where('user_id', $user->id)
                                   ->whereNull('punchOut')
                                   ->first();

            if ($existingStamp) {
                $validator->errors()->add('punchIn', 'すでに出勤打刻がされています。');
            }
        });
    }
}
