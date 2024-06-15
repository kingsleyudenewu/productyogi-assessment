<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as StatusResponse;

trait HasApiResponse
{
    public function toJsonResponse(string $message, int $status, $data = null): JsonResponse
    {
        $isSuccessful = $status >= 100 && $status < 400;

        $response = ["status" => $isSuccessful ? 'success' : 'error', 'message' => $message];

        if (!empty($data)) {
            $response[$isSuccessful ? 'data' : 'error'] = $data;
        }

        if ($data instanceof JsonResponse) {
            $data = $data->getData(true);

            $response['data'] = Arr::get($data, 'data');
            $response['meta'] = Arr::get($data, 'meta');
            $response['links'] = Arr::get($data, 'links');
        }

        return new JsonResponse($response, $status);
    }

    /**
     * Set the success response alert.
     *
     * @param $message
     * @param $data
     *
     * @return JsonResponse
     */
    public function successResponse($message, $data = null): JsonResponse
    {
        return $this->toJsonResponse($message, StatusResponse::HTTP_OK, $data);
    }

    /**
     * Set the created resource response alert.
     *
     * @param $message
     * @param $data
     *
     * @return JsonResponse
     */
    public function createdResponse($message, $data = null): JsonResponse
    {
        return $this->toJsonResponse($message, StatusResponse::HTTP_CREATED, $data);
    }

    /**
     * Set the "not found" error response.
     *
     * @param $message
     * @param null $data
     *
     * @return JsonResponse
     */
    public function notFoundAlert($message, $data = null): JsonResponse
    {
        return $this->toJsonResponse($message, StatusResponse::HTTP_NOT_FOUND, $data);
    }

    /**
     * Set bad request error response.
     *
     * @param string $message
     * @param null $data
     *
     * @return JsonResponse
     */
    public function badRequestAlert(string $message, $data = null): JsonResponse
    {
        return $this->toJsonResponse($message, 400, $data);
    }

    /**
     * Set forbidden request error response.
     *
     * @param null $data
     *
     * @return JsonResponse
     */
    public function formValidationErrorAlert($data = null): JsonResponse
    {
        return $this->toJsonResponse('Validation error occurred.', StatusResponse::HTTP_UNPROCESSABLE_ENTITY, $data);
    }
}
