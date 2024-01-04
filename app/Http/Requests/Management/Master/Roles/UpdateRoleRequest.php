<?php

namespace App\Http\Requests\Management\Master\Roles;

use App\Enums\Table;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRoleRequest extends FormRequest
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
            "permissions" => "array",
            "permissions.*" => [Rule::exists(Table::PERMISSIONS->value, "id")],
        ];
    }
}
