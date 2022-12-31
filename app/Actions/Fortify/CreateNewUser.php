<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

  
        return User::create([
            'name' => $input['lname']." ".$input['fname'] ,
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'hbt' => $input['hbt'] ?? null,
            'fname' => $input['fname'] ?? null,
            'lname' => $input['lname'] ?? null,
            'tel' => $input['tel'] ?? null,
            'sexe' => $input['sexe'] ?? null,
            'type' => $input['type'] ?? null,
            'role' => $input['role'] ?? null,
            'typesalaire' => $input['typesalaire'] ?? null,
            'poste' => $input['poste'] ?? null,
            'etatserveur' => $input['etatserveur'] ?? null,
            'iddiplome' => $input['iddiplome'] ?? null,

        ]);
    }
}
