<?php

namespace App\Http\Api\Companies\Controllers;

use App\Domain\Companies\Actions\AttachResourcesToCompanyAction;
use App\Domain\Companies\Actions\ChangeCompanyAction;
use App\Domain\Companies\Actions\CreateCompanyAction;
use App\Domain\Companies\Actions\DeleteCompanyAction;
use App\Domain\Companies\Actions\DetachResourcesFromCompanyAction;
use App\Domain\Companies\Actions\GetAllCompanyAction;
use App\Domain\Companies\Actions\GetAttachedResourcesToCompanyAction;
use App\Domain\Companies\Actions\GetAttachedWorkersToCompanyAction;
use App\Domain\Companies\Actions\GetCompanyAction;
use App\Domain\Companies\Actions\UpdateCompanyAction;
use App\Domain\Companies\Models\Company;
use App\Exceptions\NotFoundException;
use App\Http\Api\Companies\Requests\AttachResourcesToCompanyRequest;
use App\Http\Api\Companies\Requests\ChangeCompanyRequest;
use App\Http\Api\Companies\Requests\CreateCompanyRequest;
use App\Http\Api\Companies\Requests\DetachResourcesFromCompanyRequest;
use App\Http\Api\Companies\Requests\UpdateCompanyRequest;
use App\Http\Api\Companies\Resources\AllCompanyResources;
use App\Http\Api\Companies\Resources\CompanyResource;
use App\Http\Api\Resources\Resources\AllResourceResources;
use App\Http\Api\Workers\Resources\AllWorkerResources;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

use OpenApi\Attributes as OA;

class CompanyController extends Controller
{
    #[OA\Get(
        path: '/api/companies',
        operationId: 'getAllCompanies',
        summary: 'Get all companies',
        tags: ['Company'],
        responses: [
            new OA\Response(response: 200, description: 'Everything is fine'),
            new OA\Response(response: 500, description: 'Server error'),
        ]
    )]
    public function index(GetAllCompanyAction $action): AllCompanyResources
    {
        $company = $action->execute();
        return new AllCompanyResources($company);
    }

    #[OA\Post(
        path: '/api/companies',
        operationId: 'postCompany',
        summary: 'Post company',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(example: [
                'name' => 'sxope-ocean',
            ])
        ),
        tags: ['Company'],
        responses: [
            new OA\Response(response: 201, description: 'Everything is fine'),
            new OA\Response(response: 400, description: 'Bad request'),
            new OA\Response(response: 500, description: 'Server error'),
        ]
    )]
    public function store(CreateCompanyAction $action,
                            CreateCompanyRequest $request): CompanyResource|JsonResponse
    {
        $company = $action->execute($request->validated());
        if (!$company) {
            return response()->json(['data' => 'Bad request'], 400);
        }
        return new CompanyResource($company);
    }

    #[OA\Get(
        path: '/api/companies/{company_id}',
        operationId: 'getCompany',
        summary: 'Get company by id',
        tags: ['Company'],
        parameters: [
            new OA\Parameter(name: 'company_id', description: 'company ID', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(response: 200, description: 'Everything is fine'),
            new OA\Response(response: 404, description: 'Not found'),
            new OA\Response(response: 500, description: 'Server error'),
        ]
    )]
    public function show(int $id, GetCompanyAction $action): CompanyResource|JsonResponse
    {
        try {
            $company = $action->execute($id);
        } catch (NotFoundException $exception) {
            return response()->json(['data' => null, 'errors' => $exception->getMessage()], 404);
        }
        if (!$company) {
            return response()->json(['data' => 'Bad request'], 400);
        }
        return new CompanyResource($company);
    }

    #[OA\Patch(
        path: '/api/companies/{company_id}',
        operationId: 'changeCompany',
        summary: 'Change company by id',
        requestBody: new OA\RequestBody(
            required: false,
            content: new OA\JsonContent(example: [
                'name' => 'sxope-ocean',
            ])
        ),
        tags: ['Company'],
        parameters: [
            new OA\Parameter(name: 'company_id', description: 'company ID', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(response: 200, description: 'Everything is fine'),
            new OA\Response(response: 400, description: 'Bad request'),
            new OA\Response(response: 404, description: 'Not found'),
            new OA\Response(response: 500, description: 'Server error'),
        ]
    )]
    public function change(ChangeCompanyRequest $request,
                            ChangeCompanyAction $action, int $id): CompanyResource|JsonResponse
    {
        try {
            $company = $action->execute($id, $request->validated());
        } catch (NotFoundException $exception) {
            return response()->json(['data' => null, 'errors' => $exception->getMessage()], 404);
        }
        if (!$company) {
            return response()->json(['data' => 'Bad request'], 400);
        }
        return new CompanyResource($company);
    }

    #[OA\Put(
        path: '/api/companies/{company_id}',
        operationId: 'updateCompany',
        summary: 'Update company by id',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(example: [
                'name' => 'sxope-ocean',
            ])
        ),
        tags: ['Company'],
        parameters: [
            new OA\Parameter(name: 'company_id', description: 'company ID', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(response: 200, description: 'Everything is fine'),
            new OA\Response(response: 400, description: 'Bad request'),
            new OA\Response(response: 404, description: 'Not found'),
            new OA\Response(response: 500, description: 'Server error'),
        ]
    )]
    public function update(UpdateCompanyRequest $request,
                            UpdateCompanyAction $action, int $id): CompanyResource|JsonResponse
    {
        try {
            $company = $action->execute($id, $request->validated());
        } catch (NotFoundException $exception) {
            return response()->json(['data' => null, 'errors' => $exception->getMessage()], 404);
        }
        if (!$company) {
            return response()->json(['data' => 'Bad request'], 400);
        }
        return new CompanyResource($company);
    }

    #[OA\Delete(
        path: '/api/companies/{company_id}',
        operationId: 'deleteCompany',
        summary: 'Delete company by id',
        tags: ['Company'],
        parameters: [
            new OA\Parameter(name: 'company_id', description: 'company ID', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(response: 200, description: 'Everything is fine'),
            new OA\Response(response: 404, description: 'Not found'),
            new OA\Response(response: 500, description: 'Server error'),
        ]
    )]
    public function destroy(int $id,
                            DeleteCompanyAction $action): JsonResponse
    {
        try {
            $action->execute($id);
        } catch (NotFoundException $exception) {
            return response()->json(['data' => null, 'errors' => $exception->getMessage()], 404);
        }
        return response()->json(['data' => null]);
    }

    #[OA\Post(
        path: '/api/companies/{companyId}/resources',
        operationId: 'attachResourcesToCompany',
        summary: 'Attach 1 or more resources to the specific company',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(example: [
                'resource_ids' => '1, 2, 3'
            ])
        ),
        tags: ['Company and resources'],
        parameters: [
            new OA\Parameter(name: 'companyId', description: 'company ID', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(response: 201, description: 'Everything is fine'),
            new OA\Response(response: 400, description: 'Bad request'),
            new OA\Response(response: 404, description: 'Not found'),
            new OA\Response(response: 500, description: 'Server error'),
        ]
    )]
    public function attachResourcesToCompany($companyId,
                                             AttachResourcesToCompanyAction $action,
                                            AttachResourcesToCompanyRequest $request): JsonResponse|AllResourceResources
    {
        try {
            $resources = $action->execute($companyId, $request->validated());
        } catch (NotFoundException $exception) {
            return response()->json(['data' => null, 'errors' => $exception->getMessage()], 404);
        }
        if (!$resources) {
            return response()->json(['data' => 'Bad request'], 400);
        }
        return new AllResourceResources($resources);
    }

    #[OA\Get(
        path: '/api/companies/{companyId}/resources',
        operationId: 'getResourcesAttachedToCompany',
        summary: 'Get a list of resources attached to the specific company',
        tags: ['Company and resources'],
        parameters: [
            new OA\Parameter(name: 'companyId', description: 'company ID', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(response: 200, description: 'Everything is fine'),
            new OA\Response(response: 404, description: 'Not found'),
            new OA\Response(response: 500, description: 'Server error'),
        ]
    )]
    public function getResourcesAttachedToCompany(int $companyId,
                                                    GetAttachedResourcesToCompanyAction $action): JsonResponse|AllResourceResources
    {
        try {
            $resource = $action->execute($companyId);
        } catch (NotFoundException $exception) {
            return response()->json(['data' => null, 'errors' => $exception->getMessage()], 404);
        }
        return new AllResourceResources($resource);
    }

    #[OA\Delete(
        path: '/api/companies/{companyId}/resources',
        operationId: 'detachResourcesFromCompany',
        summary: 'Detach 1 or more resources from the specific company',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(example: [
                'resource_ids' => '1, 2, 3'
            ])
        ),
        tags: ['Company and resources'],
        parameters: [
            new OA\Parameter(name: 'companyId', description: 'company ID', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(response: 201, description: 'Everything is fine'),
            new OA\Response(response: 400, description: 'Bad request'),
            new OA\Response(response: 404, description: 'Not found'),
            new OA\Response(response: 500, description: 'Server error'),
        ]
    )]
    public function detachResourcesFromCompany($companyId,
                                               DetachResourcesFromCompanyAction $action,
                                               DetachResourcesFromCompanyRequest $request): JsonResponse|AllResourceResources
    {
        try {
            $resources = $action->execute($companyId, $request->validated());
        } catch (NotFoundException $exception) {
            return response()->json(['data' => null, 'errors' => $exception->getMessage()], 404);
        }
        if (!$resources) {
            return response()->json(['data' => 'Bad request'], 400);
        }
        return new AllResourceResources($resources);
    }

    #[OA\Get(
        path: '/api/companies/{companyId}/workers',
        operationId: 'getWorkersAttachedToCompany',
        summary: 'Get a list of workers attached to the specific company',
        tags: ['Company and workers'],
        parameters: [
            new OA\Parameter(name: 'companyId', description: 'company ID', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(response: 200, description: 'Everything is fine'),
            new OA\Response(response: 404, description: 'Not found'),
            new OA\Response(response: 500, description: 'Server error'),
        ]
    )]
    public function getWorkersAttachedToCompany(int $companyId,
                                                GetAttachedWorkersToCompanyAction $action): JsonResponse|AllWorkerResources
    {
        try {
            $worker = $action->execute($companyId);
        } catch (NotFoundException $exception) {
            return response()->json(['data' => null, 'errors' => $exception->getMessage()], 404);
        }
        return new AllWorkerResources($worker);
    }
}
