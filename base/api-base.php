<?php

namespace PolylangRestapiHelper;

use \WP_Error;
use \Exception;

class Api extends ATA\Api
{
    protected function __construct()
    {
        parent::__construct();
    }


    private function build_response_data($status, $message, $data, $error)
    {
        $this->data = [
            'status'  => $status,
            'message' => $message,
            'data'    => (object) $data,
            'error'   => (object) $error,
        ];
    }
    
    protected function send_success($message = '', $data = [])
    {
        $this->build_response_data('success', $message, $data, []);
        return $this->response();
    }

    protected function send_error($message = '', $error_data = [], $http_code = 400)
    {
        status_header($http_code);
        $this->build_response_data('error', $message, [], $error_data);
        return $this->response();
    }

    protected function apiException(Exception $e)
    {
        $error_details = [
            'type' => get_class($e),
            'message' => $e->getMessage(),
        ];
        return $this->send_error('An unexpected error occurred.', $error_details, 500);
    }
}