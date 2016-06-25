<?php

namespace Yab\Quarx\Services;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ValidationService
{
    /**
     * Validation check.
     *
     * @param string $form      form in question from the config
     * @param string $module    module name
     * @param bool   $jsonInput JSON input
     *
     * @return array
     */
    public static function check($form, $jsonInput = false)
    {
        $result = [];
        $errors = [];
        $inputs = [];

        if (is_array($form)) {
            $fields = $form;
        } else {
            $conditions = Quarx::config('validation.'.$form);
            $fields = $conditions;
        }

        if (!is_array($fields)) {
            $fields = [$fields];
        }

        $validationRules = $validationInputs = [];

        foreach ($fields as $key => $value) {
            if (isset($fields[$key])) {
                $inputs[$key] = self::getInput($key, $jsonInput);
                $validationInputs[$key] = self::getInput($key, $jsonInput);
                $validationRules[$key] = $fields[$key];
            }
        }

        $validation = Validator::make($validationInputs, $validationRules);

        if ($validation->fails()) {
            $errors = $validation->messages();
        }

        if (!$jsonInput) {
            $result['redirect'] = Redirect::back()->with('errors', $errors)->with('inputs', self::inputsArray($jsonInput));
        }

        if (!empty($errors)) {
            $result['errors'] = $errors;
        } else {
            $result['errors'] = false;
        }

        $result['inputs'] = self::inputsArray($jsonInput);

        return $result;
    }

    /**
     * Json form validation.
     *
     * @param string $form   validation config
     * @param string $module module name if validation is in module
     *
     * @return mixed
     */
    public static function jsonCheck($form, $module = null)
    {
        return self::check($form, $module, true);
    }

    /**
     * ValidationService Errors.
     *
     * @param string $format Type of error request
     *
     * @return mixed
     */
    public static function errors($format = 'array')
    {
        $errorMessage = '';
        $errors = Session::get('errors') ?: false;

        if (!$errors) {
            return false;
        }

        if ($format === 'string') {
            foreach ($errors as $error => $message) {
                $errorMessage .= $message.'<br>';
            }
        } else {
            $errorMessage = Session::get('errors');
        }

        return $errorMessage;
    }

    /**
     * Validation inputs.
     *
     * @return mixed
     */
    public static function inputs()
    {
        $inputs = Session::get('inputs') ?: false;

        if (!$inputs) {
            return false;
        }

        return $inputs;
    }

    /**
     * Get input.
     *
     * @param string $key       Input name
     * @param bool   $jsonInput JSON or not
     *
     * @return mixed
     */
    private static function getInput($key, $jsonInput)
    {
        if ($jsonInput) {
            $input = Input::json($key);
        } elseif (Input::file($key)) {
            $input = Input::file($key);
        } else {
            $input = Input::get($key);
        }

        return $input;
    }

    /**
     * Get the inputs as an array.
     *
     * @param bool $jsonInput JSON or not
     *
     * @return array
     */
    private static function inputsArray($jsonInput)
    {
        if ($jsonInput) {
            $inputs = Input::json();
        } else {
            $inputs = Input::all();

            // Don't send the token back
            unset($inputs['_token']);

            foreach ($inputs as $key => $value) {
                if (Input::file($key)) {
                    unset($inputs[$key]);
                }
            }
        }

        return $inputs;
    }

    /**
     * Get the value last attempted in valuation.
     *
     * @param string $key Input key
     *
     * @return string
     */
    public static function value($key)
    {
        $inputs = Session::get('inputs') ?: false;

        if (!$inputs) {
            return '';
        }

        return $inputs[$key];
    }
}
