<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
        $today = Carbon::today()->format('Y/m/d');
        return [
            'reservation_date'=>[
                'required',
                'date_format:Y/m/d',
                function ($attribute, $value, $fail) use ($today) {
                    if ($value < $today) {
                        $fail('予約日は今日以降の日付を選択してください。');
                    }
                },
            ],
            'reservation_time'=>[
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) {
                    $allowedTimes = $this->getAllowedTimes();
                    if (!in_array($value, $allowedTimes)) {
                        $fail('予約可能な時間は 11:00 〜 20:00 の 30 分刻みです。');
                    }
                }
            ],
            'number_of_people' => [
                'required',
                'integer',
                'between:1,10',
            ],
        ];
    }

    private function getAllowedTimes()
    {
        $allowedTimes = [];
        $start = Carbon::createFromTime(11, 0);
        $end = Carbon::createFromTime(20, 0);

        while ($start <= $end) {
            $allowedTimes[] = $start->format('H:i');
            $start->addMinutes(10);
        }

        return $allowedTimes;
    }

    public function messages()
    {
        return [
            'reservation_date.required' => '予約日を選択してください。',
            'reservation_date.date_format' => '予約日は "YYYY/MM/DD" 形式で入力してください。',
            'reservation_time.required' => '予約時間を選択してください。',
            'number_of_people.required' => '人数を選択してください。',
            'number_of_people.integer' => '人数は整数で入力してください。',
            'number_of_people.between' => '人数は1人から10人まで選択可能です。',
        ];
    }
}
