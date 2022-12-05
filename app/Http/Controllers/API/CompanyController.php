<?php

namespace App\Http\Controllers\API;


use App\Http\Requests\CompanyRequest;
use App\Services\CompanyService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\API\ApiController as ApiController;
use App\Http\Requests\CompanyUpdateRequest;


class CompanyController extends ApiController
{

    /**
     * @var object|CompanyService
     */
    private object $controllerService;

    /**
     * Set Service
     *
     * @param CompanyService $service
     */
    public function __construct(CompanyService $service)
    {
        $this->controllerService = $service;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CompanyRequest  $request
     * @return JsonResponse
     */
    public function store(CompanyRequest $request) :JsonResponse
    {
       return $this->controllerService->store($request);
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
     * Update the specified resource in storage.
     *
     * @param CompanyUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(CompanyUpdateRequest $request, int $id) :JsonResponse
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

    /**
     * Show the form for creating a new resource.
     *
     * @return JsonResponse
     */
    public function create() :JsonResponse
    {
        return $this->controllerService->notSupported();
    }
}
