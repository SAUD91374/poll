<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePollRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return match ($this->input('method')) {
            'imagepoll' => $this->updatePollRules(),
            'multiplechoice' => $this->updateMultipleChoiceRules(),
            'rankingpoll' => $this->updateRankingRules(),
            default => [],
        };
    }

    public function updatePollRules()
    {
        return [
            'title' => 'required|string|max:255',
            'method' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Image is optional during update
            'options' => 'required|array|min:2',
            'options.*' => 'required|string',
            'others' => $this->input('others') ? 'string|min:3' : '',
            'description' => $this->input('description') ? 'string|min:10' : '',
        ];
    }

    public function updateMultipleChoiceRules()
    {
        return [
            'title' => 'required|string|min:2|regex:/^[^0-9].*/',
            'description' => $this->input('description') ? 'string|min:10' : '',
            'images.*' => 'nullable', // Optional in update
        ];
    }

    public function updateRankingRules()
    {
        return [
            'title' => 'required|string|regex:/^[^0-9].*/',
            'description' => 'string|min:10',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string',
        ];
    }
}
