<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\Rest;
use Carbon\Carbon;

class PunchOutRequest extends FormRequest
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

            $existingStamp = Attendance::where('user_id' ,$user->id ,)
            ->where('date', Carbon::today())
            ->whereNotNull('punchIn')
            ->whereNotNull('punchOut')
            ->first();

            if ($existingStamp) {
                $validator->errors()->add('punchOut', 'すでに出勤打刻がされています。');
            }

            $notingStamp = Attendance::where('user_id' ,$user->id ,)
            ->where('date', Carbon::today())
            ->whereNotNull('punchIn')
            ->whereNull('punchOut')
            ->first();

            if (!$notingStamp) {
                $validator->errors()->add('punchOut', '出勤打刻がされていません。');
            }

        });
    }
}
