<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\EmployeeRequest;
use App\Services\EmployeeService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\API\ApiController as ApiController;
use Illuminate\Http\Request;

/**
 * Class EmployeeController
 * @package App\Http\Controllers\API
 */
class EmployeeController extends ApiController
{
    /**
     * @var object|EmployeeService
     */
    private object $controllerService;

    /**
     * EmployeeController constructor.
     * @param EmployeeService $service
     */
    public function __construct(EmployeeService $service)
    {
        $this->controllerService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index() :JsonResponse
    {
        return $this->controllerService->index();
    }

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
     * Store a newly created resource in storage.
     *
     * @param  EmployeeRequest  $request
     * @return JsonResponse
     */
    public function store(EmployeeRequest $request) :JsonResponse
    {
        return $this->controllerService->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(int $id) :JsonResponse
    {
        return $this->controllerService->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function edit(int $id) :JsonResponse
    {
        return $this->controllerService->notSupported();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id) :JsonResponse
    {
        return $this->controllerService->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id) :JsonResponse
    {
        return $this->controllerService->destroy($id);
    }
}
