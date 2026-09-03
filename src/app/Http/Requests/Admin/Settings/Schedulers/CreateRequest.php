<?php

namespace App\Http\Requests\Admin\Settings\Schedulers;

use App\Enums\Settings\SchedulerNotificationEnum;
use App\Enums\Settings\SchedulerTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'command' => 'required|string|max:255',
            'type' => ['required', Rule::in(SchedulerTypeEnum::values())],
            'expression' => 'required|string|max:100',
            'description' => 'nullable|string|max:500',
            'is_active' => 'nullable|boolean',
            'without_overlapping' => 'nullable|boolean',
            'run_in_background' => 'nullable|boolean',
            'notification_channel' => ['nullable', Rule::in(SchedulerNotificationEnum::values())],
            'notification_recipient' => 'nullable|string|max:255',
        ];
    }
}
