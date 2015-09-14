<?php  namespace Phphub\Forms;

use Laracasts\Validation\FormValidator;

class UserLoginForm extends FormValidator
{
    protected $rules = [
        'name'            => 'alpha_num|required',
        'password'        => 'required',
    ];
}
