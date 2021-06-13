<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'appId' => 'string',
            'os' => 'string',
            'startDate' => 'string',
            'endDate' => 'string',
        ];
    }

    /**
     * @return bool
     */
    public function isValidDateRange(): bool
    {
        if (!$this->has('endDate')) {
            return true;
        }

        if (!$this->has('startDate')) {
            return false;
        }

        $startDate = Carbon::createFromFormat('d-m-Y', $this->input('startDate'));
        $endDate = Carbon::createFromFormat('d-m-Y', $this->input('endDate'));

        return $endDate >= $startDate;
    }
}
