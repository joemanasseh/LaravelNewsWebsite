<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Auth;
use App\User;
use Illuminate\Support\Facades\Hash;

class matchpass implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        $id = Auth::id();
        $user = User::find($id);
        return Hash::check($value, $user->password);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The old password is incorrect!';
    }
}
