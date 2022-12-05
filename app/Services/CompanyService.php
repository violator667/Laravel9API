<?php


namespace App\Services;

use App\Http\Requests\CompanyRequest as CompanyRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Http\Resources\Company as CompanyResource;
use App\Models\Company as Company;
use Illuminate\Http\JsonResponse;
use App\Services\ApiService as ApiService;

/**
 * Class CompanyService
 * @package App\Services
 */
class CompanyService extends ApiService
{
    /**
     * @var object|Company
     */
    private object $model;
    /**
     * @var string
     */
    private string $model_name_singular = "Company";
    /**
     * @var string
     */
    private string $model_name_plural = "Companies";

    /**
     * CompanyService constructor.
     * @param Company $company
     */
    public function __construct(Company $company)
    {
        $this->model = $company;
    }

    /**
     * @param CompanyRequest $request
     * @return JsonResponse
     */
    public function store(CompanyRequest $request) :JsonResponse
    {
        if($this->model::where('nip', $request->nip)->count()===0)
        {
            $this->model::create($request->all());
            $this->setJsonData(new CompanyResource($request->all()));
            $this->setJsonError(false);
            $this->setJsonMessage(__($this->model_name_singular.' Created.'));
            $this->setJsonStatus(201);
            return $this->returnJsonResponse();
        }
        $this->setJsonError(true);
        $this->setJsonData(new CompanyResource($request->all()));
        $this->setJsonMessage(__($this->model_name_singular.' already exists in DB.'));
        return $this->returnJsonResponse();
    }

    /**
     * @return JsonResponse
     */
    public function index() :JsonResponse
    {
        $this->setJsonError(false);
        $this->setJsonData($this->model::with('employees')->get());
        $this->setJsonMessage(__('All '. strtolower($this->model_name_plural) .' retrieved.'));
        return $this->returnJsonResponse();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id) :JsonResponse
    {
        if(!$this->findModelOrFail($id)) {
            return $this->returnJsonResponse();
        }
        $this->setJsonError(false);
        $this->setJsonData($this->findModelOrFail($id));
        $this->setJsonMessage(__($this->model_name_singular.' retrieved.'));
        return $this->returnJsonResponse();
    }

    /**
     * @param CompanyUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(CompanyUpdateRequest $request, int $id) :JsonResponse
    {
        if(!$this->findModelOrFail($id)) {
            return $this->returnJsonResponse();
        }

        $this->model->update($request->all());
        $this->setJsonError(false);
        $this->setJsonData(null);
        $this->setJsonMessage(__($this->model_name_singular.' updated.'));
        return $this->returnJsonResponse();

    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id) :JsonResponse
    {
        $model = $this->findModelOrFail($id);
        if(!$model) {
            return $this->returnJsonResponse();
        }
        if($model->employees->count()>0)
        {
            foreach ($model->employees as $employee)
            {
                $employee->delete();
            }
        }
        $model->delete();
        $this->setJsonError(false);
        $this->setJsonData(null);
        $this->setJsonMessage(__($this->model_name_singular.' deleted.'));
        return $this->returnJsonResponse();
    }

    /**
     * @param int $id
     * @return Company|null
     */
    private function findModelOrFail(int $id): Company|null
    {
        $model = $this->model::with('employees')->find($id);
        if($model)
        {
            return $model;
        }
        $this->setJsonError(true);
        $this->setJsonData(null);
        $this->setJsonMessage(__($this->model_name_singular.' not found.'));
        $this->setJsonStatus(404);
        return null;
    }

}
