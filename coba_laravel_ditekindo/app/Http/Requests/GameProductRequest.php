<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class GameProductRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
   public function rules()
{
    $gameproduct = $this->route('gameproduct');
    $id = is_object($gameproduct) ? $gameproduct->id : $gameproduct;

    return [
            'name' => 'required|string|min:3|max:255|unique:game_products,name,' . $id,
            'category' => 'required|string|min:3|max:255',
            'description' => 'nullable|string|max:1000',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama game wajib diisi.',
            'category.required' => 'Kategori game wajib diisi.',
            'stok.required' => 'Stok wajib diisi.',
            'stok.integer' => 'Stok harus berupa angka bulat.',
            'stok.min' => 'Stok tidak boleh negatif.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga tidak boleh negatif.',
        ];
    }
}
