<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class FormProjectsRequest extends Request {

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
        $name = 'required|unique:projects,name';
        if($this->has('id')) {
            $name .= ','.$this->get('id');
        }
		return [
			'name'  => $name,
            'description' => 'required',
            'users' => 'required'
		];
	}

}
