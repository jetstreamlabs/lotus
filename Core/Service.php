<?php

namespace Serenity\Lotus\Core;

use Serenity\Lotus\Payloads\InertiaPayload;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Serenity\Lotus\Contracts\PayloadContract;
use Serenity\Lotus\Contracts\ServiceContract;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Service implements ServiceContract
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Return a successful response payload.
     *
     * @param  array   $data
     * @param  integer $status
     * @return \Serenity\Lotus\Contracts\PayloadContract
     */
    public function successResponse(array $data, $status = 303): PayloadContract
    {
        return $this->respond($data['message'], 'success', $data['route'], $status);
    }

    /**
     * Return an error response payload.
     *
     * @param  array   $data
     * @param  integer $status
     * @return \Serenity\Lotus\Contracts\PayloadContract
     */
    public function errorResponse(array $data, $status = 302): PayloadContract
    {
        return $this->respond($data['message'], 'error', $data['route'], $status);
    }

    /**
     * Return an info response payload.
     *
     * @param  array   $data
     * @param  integer $status
     * @return \Serenity\Lotus\Contracts\PayloadContract
     */
    public function infoResponse(array $data, $status = 303): PayloadContract
    {
        return $this->respond($data['message'], 'info', $data['route'], $status);
    }

    /**
     * Return a warning response payload.
     *
     * @param  array   $data
     * @param  integer $status
     * @return \Serenity\Lotus\Contracts\PayloadContract
     */
    public function warningResponse(array $data, $status = 303): PayloadContract
    {
        return $this->respond($data['message'], 'warning', $data['route'], $status);
    }

    /**
     * Build up a payload response.
     * @param  array  $data
     * @return \Serenity\Lotus\Contracts\PayloadContract
     */
    public function payloadResponse(array $data): PayloadContract
    {
        return $this->payload()->setData($data);
    }

    /**
     * Build up and return a payload.
     *
     * @param  string  $message
     * @param  string  $level
     * @param  string  $route
     * @param  integer $status
     * @return \Serenity\Lotus\Contracts\PayloadContract
     */
    public function respond($message, $level, $route, $status): PayloadContract
    {
        return $this->payload()->setData([
            'message' => $message,
            'level'   => $level,
            'route'   => $route,
            'status'  => $status,
        ]);
    }

    /**
     * Generate a new payload instance.
     *
     * @return \Serenity\Lotus\Contracts\PayloadContract
     */
    public function payload(): PayloadContract
    {
        return app(InertiaPayload::class);
    }
}
