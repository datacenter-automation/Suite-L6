<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiRespondable
{

    /**
     * @var int
     */
    protected int $statusCode = Response::HTTP_OK;

    /**
     * @var string
     */
    protected string $description = '';

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription(string $description): ApiRespondable
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param $statusCode
     *
     * @return $this
     */
    public function setStatusCode($statusCode): ApiRespondable
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @param string $message
     *
     * @return mixed
     */
    public function notFound($message = 'Not Found') // 404
    {
        return $this->setStatusCode(Response::HTTP_NOT_FOUND)->respondWithError($message);
    }

    /**
     * @param string $message
     *
     * @return mixed
     */
    public function badRequest($message = 'Bad Request') // 400
    {
        return $this->setStatusCode(Response::HTTP_BAD_REQUEST)->respondWithError($message);
    }

    /**
     * @param string $message
     *
     * @return mixed
     */
    public function serverError($message = 'Server Error') // 500
    {
        return $this->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($message);
    }

    /**
     * @param string $message
     *
     * @return mixed
     */
    public function conflict($message = 'Conflict') // 409
    {
        return $this->setStatusCode(Response::HTTP_CONFLICT)->respondWithError($message);
    }

    /**
     * @param string $message
     *
     * @return mixed
     */
    public function unprocessable($message = 'Unprocessable Entity') // 422
    {
        return $this->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY)->respondWithError($message);
    }

    /**
     * @param string $message
     *
     * @return mixed
     */
    public function unauthorized($message = 'Unauthorized') // 401
    {
        return $this->setStatusCode(Response::HTTP_UNAUTHORIZED)->respondWithError($message);
    }

    /**
     * @param string $message
     *
     * @return mixed
     */
    public function forbidden($message = 'Forbidden') // 403
    {
        return $this->setStatusCode(Response::HTTP_FORBIDDEN)->respondWithError($message);
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function created($data = []) // 201
    {
        return $this->setStatusCode(Response::HTTP_CREATED)->respond($data);
    }

    /**
     * @param       $data
     * @param array $headers
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respond($data, $headers = []) // 200
    {
        return response()->json($data, $this->getStatusCode(), $headers);
    }

    /**
     * @param $message
     *
     * @return mixed
     */
    public function respondWithError($message) // General Error
    {
        return $this->respond([
            'error' => [
                'status_code' => $this->getStatusCode(),
                'data'        => $message,
                'description' => $this->getDescription(),
            ],
        ]);
    }
}
