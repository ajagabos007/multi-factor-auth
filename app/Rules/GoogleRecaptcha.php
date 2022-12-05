<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use GuzzleHttp\Client;

class GoogleRecaptcha implements InvokableRule
{
    /**
     * Indicates whether the rule should be implicit.
     *
     * @var bool
     */
    public $implicit = true;

    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        // if (strtoupper($value) !== $value) {
        //     $fail('The :attribute must be uppercase.');
        // }

        $client = new Client;
        $response = $client->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'form_params' =>
                    [
                        'secret' => config('services.google_recaptcha.secret_key'),
                        'response' => $value
                    ]
            ]
        );
        $body = json_decode((string)$response->getBody());
        // if(!$body->success)
        //     $fail('The :attribute must be checked.');
        return $body->success;
    }
}
