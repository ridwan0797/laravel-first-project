<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Rules
    |--------------------------------------------------------------------------
    |
    | This array will be merged with the validation rules array of each field being validated.
    | You can use this array to add your own custom validation rules to specific fields.
    |
    */

    'custom_rules' => [
        'email' => ['required', 'email'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Messages
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to customize the validation messages.
    | You are free to modify these language lines according to your application's requirements.
    |
    */

    'custom_messages' => [
        'email.required' => 'The email field is required.',
        'email.email' => 'Please enter a valid email address.',
    ],
];
