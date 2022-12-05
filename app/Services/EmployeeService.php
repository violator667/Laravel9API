<?php


namespace App\Services;

use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\Employee as EmployeeResource;
use App\Models\Employee as Employee;
use Illuminate\Http\JsonResponse;
use App\Services\ApiService as ApiService;
use Illuminate\Http\Request;

/**
 * Class EmployeeService
 * @package App\Services
 */
class EmployeeService extends ApiService
{
    private object $model;
    private string $model_name_singular = "Employee";
    private string $model_name_plural = "Employees";

    /**
     * CompanyService constructor.
     * @param Employee $employee
     */
    public function __construct(Employee $employee)
    {
        $this->model = $employee;
    }

    public function store(EmployeeRequest $request) :JsonResponse
    {

        $this->model::create($request->all());
        $this->setJsonData(new EmployeeResource($request->all()));
        $this->setJsonError(false);
        $this->setJsonMessage(__($this->model_name_singular.' Created.'));
        $this->setJsonStatus(201);
        return $this->returnJsonResponse();
    }

    public function index() :JsonResponse
    {
        $this->setJsonError(false);
        $this->setJsonData($this->model->with('company')->get());
        $this->setJsonMessage(__('All '. strtolower($this->model_name_plural) .' retrieved.'));
        return $this->returnJsonResponse();
    }

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

    public function update(Request $request, int $id) :JsonResponse
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

    public function destroy(int $id) :JsonResponse
    {
        $model = $this->findModelOrFail($id);
        if(!$model) {
            return $this->returnJsonResponse();
        }

        $model->delete();
        $this->setJsonError(false);
        $this->setJsonData(null);
        $this->setJsonMessage(__($this->model_name_singular.' deleted.'));
        return $this->returnJsonResponse();
    }

    private function findModelOrFail(int $id): Employee|null
    {

        $model = $this->model->find($id);
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
