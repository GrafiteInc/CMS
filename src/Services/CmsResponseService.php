<?php

namespace Grafite\Cms\Services;

use Illuminate\Support\Facades\Response;

class CmsResponseService
{
    /**
     * Generate an api response.
     *
     * @param string $type    Response type
     * @param string $message Response string
     *
     * @return Response
     */
    public function apiResponse($type, $message, $code = 200)
    {
        return Response::json(['status' => $type, 'data' => $message], $code);
    }

    /**
     * Generate an API error response.
     *
     * @param array $errors Validation errors
     * @param array $inputs Input values
     *
     * @return Response
     */
    public function apiErrorResponse($errors, $inputs)
    {
        $message = [];
        foreach ($inputs as $key => $value) {
            if (!isset($errors[$key])) {
                $message[$key] = [
                    'status' => 'valid',
                    'value' => $value,
                ];
            } else {
                $message[$key] = [
                    'status' => 'invalid',
                    'error' => $errors[$key],
                    'value' => $value,
                ];
            }
        }

        return Response::json(['status' => 'error', 'data' => $message]);
    }
}
