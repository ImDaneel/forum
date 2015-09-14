<?php  namespace Phphub\Forms;

use Laracasts\Validation\FormValidator;

class UserSignupForm extends FormValidator
{
    protected $rules = [
        'name'                  => 'alpha_num|required|unique:users',
        'password'              => 'required|confirmed',
        'password_confirmation' => 'required',
        'email'                 => 'email'
    ];
}
