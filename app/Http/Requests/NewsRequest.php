<?php

namespace App\Http\Requests;

use App\Models\News;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

/**
 * Class NewsRequest
 *
 * @property-read News $news
 * @property-read string $tags
 */
class NewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
            'title' => 'required|min:5|max:100',
            'slug' => 'required|alpha_dash|unique:news,slug,' . (optional($this->news)->id ?: null),
            'description' => 'required|max:255',
            'content' => 'required',
            'is_posted' => 'boolean',
            'tags' => 'array',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(
            [
                'tags' => explode(',', $this->tags),
            ]
        );
    }
    
    protected function passedValidation()
    {
        $tags =
            collect($this->tags)
                ->map(fn($val) => Str::of($val)->trim())
                ->reject(fn($val) => Str::of($val)->isEmpty());

        $this->merge(
            [
                'tags' => $tags,
            ]
        );
    }
}
