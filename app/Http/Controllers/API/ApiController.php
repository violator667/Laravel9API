<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{

    /**
     * @var object
     */
    protected object $controllerService;

    /**
     * Show the form for creating a new resource.
     *
     * @return JsonResponse
     */
    public function create() :JsonResponse
    {
        return $this->controllerService->notSupported();
    }

    /**
     * Show edit form
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function edit(int $id) :JsonResponse
    {
        return $this->controllerService->notSupported();
    }
}
