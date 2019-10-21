<?php

/**
 * create rest_api response if doesnt exists
 * @param mixed data
 * @param array attribute
 * @param integer response code
 * @return \Illuminate\Http\Response
 */
if (!function_exists('rest_api')) {
    function rest_api($data, $many = false, $code = 200)
    {
        $attribute = $many ? (array('items' => $data)) : $data;

        $rest = [
            "version"       => config("api.version"),
            "status_code"   => $code,
            "data"          => $attribute
        ];

        return response()->json($rest, $code);
    }
}

/**
 * create rest_api response if doesnt exists
 * @param mixed data
 * @param array attribute
 * @param integer response code
 * @return \Illuminate\Http\Response
 */
if (!function_exists('rest_api_xml')) {
    function rest_api_xml($data, $code = 200)
    {
        $setToXml = $data->asXML();
        return response()->xml($setToXml);
    }
}

/**
 * create rest_api error response if doesnt exists
 * @param string|array|object message
 * @param mixed additional data
 * @param integer response code
 * @return \Illuminate\Http\Response
 */
if (!function_exists('rest_error')) {
    function rest_error($message, $data = null, $code = 400)
    {

        $rest = [
            "version" => config("api.version"),
            "error" => [
                "code" => $code,
                "message" => $message,
            ]
        ];

        if ($data)
            $rest['error']['errors'] = $data;

        return response()->json($rest, $code);
    }
}


if (!function_exists('glob_recursive')) {

    /**
     * glob recursive find some file with ext
     *
     * @param string $pattern
     * @param integer $flags
     * @return void
     */
    function glob_recursive($pattern, $flags = 0)
    {
        $files = glob($pattern, $flags);
        foreach (glob(dirname($pattern) . '/*', GLOB_ONLYDIR | GLOB_NOSORT) as $dir) {
            $files = array_merge($files, glob_recursive($dir . '/' . basename($pattern), $flags));
        }
        return $files;
    }

/**
 * Response API for apps is need array format, so this is the builder
 *
 * @param int $statusCode
 * @param array $data
 *
 * @return \Illuminate\Http\JsonResponse
 */
function apiResponse($statusCode = 500, $data = [])
{
    return response()->json([
        'status_code' => $statusCode,
        'data' => $data,
    ], $statusCode);
}

}
