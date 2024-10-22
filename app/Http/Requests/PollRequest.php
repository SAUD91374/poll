<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PollRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // dd('hello');
        return match ($this->input('method')) {
            'imagepoll' => $this->pollRules(),
            'multiplechoice' => $this->multipleChoiceRules(),
            'rankingpoll' => $this->rankingRules(),
            default => [],
        };
    }

    public function pollRules()
    {
        return [
            'title' => 'required|string|max:255',
            'method' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'options' => 'required|array|min:2', // At least 2 options are required
            'options.*' => 'required|string',    // Each option must be a string
            'others' =>  $this->input('others') ? 'string|min:3' : '',
            'description' => $this->input('description') ? 'string|min:10' : '',

        ];
    }


    public function multipleChoiceRules()
    {
        // if user enter desciption then validation applied otherwise not
        return [

            'title' => 'required|string|min:2|regex:/^[^0-9].*/',
            'description' => $this->input('description') ? 'string|min:10' : '',
            'images.*'=>'required',

        ];
    }

    public function rankingRules()
    {
        return [
            'title' => 'required|string|regex:/^[^0-9].*/',
            'description' => 'string|min:10',
            'options' => 'required|array|min:2', // At least 2 options are required
            'options.*' => 'required|string',    // Each option must be a string

        ];
    }
    public function messages()
    {
        return [
            'options.required' => 'Options field is required',
            'options.array' => 'Options field must be an array',
            'options.*.required' => 'Option must be filled',
            'options.*.string' => 'Each option must be a valid string', // Ensures each option is a string
            'others.string'=>'Others option must be filled',
            'images.*.required'=>'Option must be Filled'
        ];
    }
}
