<?php


namespace App\Services;

use Illuminate\Http\JsonResponse;

/**
 * Class ApiService
 * @package App\Services
 */
class ApiService
{
    /**
     * @var int
     */
    protected int $jsonStatus = 200;
    /**
     * @var string
     */
    protected string $jsonMessage;
    /**
     * @var bool
     */
    protected bool $jsonError;
    /**
     * @var object|null|string
     */
    protected object|null|string $jsonData;

    /**
     * @param int $status
     */
    public function setJsonStatus(int $status) :void
    {
        $this->jsonStatus = $status;
    }

    /**
     * @param string $message
     */
    public function setJsonMessage(string $message) :void
    {
        $this->jsonMessage = $message;
    }

    /**
     * @param bool $error
     */
    public function setJsonError(bool $error) :void
    {
        $this->jsonError = $error;
    }

    /**
     * @param object|null $data
     */
    public function setJsonData(object|null|string $data) :void
    {
        $this->jsonData = $data;
    }

    /**
     * @return JsonResponse
     */
    public function notSupported() :JsonResponse
    {
        $this->setJsonStatus(404);
        $this->setJsonData(null);
        $this->setJsonMessage(__('Not supported in this API.'));
        $this->setJsonError(true);
        return $this->returnJsonResponse();
    }

    /**
     * @return JsonResponse
     */
    public function returnJsonResponse() :JsonResponse
    {
        $response['error'] = $this->jsonError;
        $response['message'] = $this->jsonMessage;
        $response['data'] = $this->jsonData;

        return response()->json($response, $this->jsonStatus);
    }
}
