<?php

namespace App\Http\Api\Resources\Controllers;

use App\Domain\Resources\Actions\ChangeResourceAction;
use App\Domain\Resources\Actions\CreateResourceAction;
use App\Domain\Resources\Actions\DeleteResourceAction;
use App\Domain\Resources\Actions\GetAllResourceAction;
use App\Domain\Resources\Actions\GetResourceAction;
use App\Domain\Resources\Actions\UpdateResourceAction;
use App\Domain\Resources\Models\Resource;
use App\Exceptions\NotFoundException;
use App\Http\Api\Resources\Requests\ChangeResourceRequest;
use App\Http\Api\Resources\Requests\CreateResourceRequest;
use App\Http\Api\Resources\Requests\UpdateResourceRequest;
use App\Http\Api\Resources\Resources\AllResourceResources;
use App\Http\Api\Resources\Resources\ResourceResource;
use App\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;
class ResourceController extends Controller
{
    #[OA\Get(
        path: '/api/resources',
        operationId: 'getAllResources',
        summary: 'Get all resources',
        tags: ['Resource'],
        responses: [
            new OA\Response(response: 200, description: 'Everything is fine'),
            new OA\Response(response: 500, description: 'Server error'),
        ]
    )]
    public function index(GetAllResourceAction $action): AllResourceResources
    {
        $resource = $action->execute();
        return new AllResourceResources($resource);
    }

    #[OA\Post(
        path: '/api/resources',
        operationId: 'postResource',
        summary: 'Post Resource',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(example: [
                'name' => 'Oil',
                'place' => 'Kazan'
            ])
        ),
        tags: ['Resource'],
        responses: [
            new OA\Response(response: 201, description: 'Everything is fine'),
            new OA\Response(response: 400, description: 'Bad request'),
            new OA\Response(response: 500, description: 'Server error'),
        ]
    )]
    public function store(CreateResourceAction $action,
                          CreateResourceRequest $request): ResourceResource|JsonResponse
    {
        $resource = $action->execute($request->validated());
        if (!$resource) {
            return response()->json(['data' => 'Bad request'], 400);
        }
        return new ResourceResource($resource);
    }

    #[OA\Get(
        path: '/api/resources/{resource_id}',
        operationId: 'getResource',
        summary: 'Get Resource by id',
        tags: ['Resource'],
        parameters: [
            new OA\Parameter(name: 'resource_id', description: 'Resource ID', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(response: 200, description: 'Everything is fine'),
            new OA\Response(response: 404, description: 'Not found'),
            new OA\Response(response: 500, description: 'Server error'),
        ]
    )]
    public function show(int $id, GetResourceAction $action): ResourceResource|JsonResponse
    {
        try {
            $resource = $action->execute($id);
        } catch (NotFoundException $exception) {
            return response()->json(['data' => null, 'errors' => $exception->getMessage()], 404);
        }
        if (!$resource) {
            return response()->json(['data' => 'Bad request'], 400);
        }
        return new ResourceResource($resource);
    }

    #[OA\Patch(
        path: '/api/resources/{resource_id}',
        operationId: 'changeResource',
        summary: 'Change Resource by id',
        requestBody: new OA\RequestBody(
            required: false,
            content: new OA\JsonContent(example: [
                'name' => 'Oil',
                'place' => 'Kazan'
            ])
        ),
        tags: ['Resource'],
        parameters: [
            new OA\Parameter(name: 'resource_id', description: 'Resource ID', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(response: 200, description: 'Everything is fine'),
            new OA\Response(response: 400, description: 'Bad request'),
            new OA\Response(response: 404, description: 'Not found'),
            new OA\Response(response: 500, description: 'Server error'),
        ]
    )]
    public function change(ChangeResourceRequest $request,
                           ChangeResourceAction $action, int $id): ResourceResource|JsonResponse
    {
        try {
            $resource = $action->execute($id, $request->validated());
        } catch (NotFoundException $exception) {
            return response()->json(['data' => null, 'errors' => $exception->getMessage()], 404);
        }
        if (!$resource) {
            return response()->json(['data' => 'Bad request'], 400);
        }
        return new ResourceResource($resource);
    }

    #[OA\Put(
        path: '/api/resources/{resource_id}',
        operationId: 'updateResource',
        summary: 'Update Resource by id',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(example: [
                'name' => 'Oil',
                'place' => 'Kazan'
            ])
        ),
        tags: ['Resource'],
        parameters: [
            new OA\Parameter(name: 'resource_id', description: 'Resource ID', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(response: 200, description: 'Everything is fine'),
            new OA\Response(response: 400, description: 'Bad request'),
            new OA\Response(response: 404, description: 'Not found'),
            new OA\Response(response: 500, description: 'Server error'),
        ]
    )]
    public function update(UpdateResourceRequest $request,
                           UpdateResourceAction $action, int $id): ResourceResource|JsonResponse
    {
        try {
            $resource = $action->execute($id, $request->validated());
        } catch (NotFoundException $exception) {
            return response()->json(['data' => null, 'errors' => $exception->getMessage()], 404);
        }
        if (!$resource) {
            return response()->json(['data' => 'Bad request'], 400);
        }
        return new ResourceResource($resource);
    }

    #[OA\Delete(
        path: '/api/resources/{resource_id}',
        operationId: 'deleteResource',
        summary: 'Delete Resource by id',
        tags: ['Resource'],
        parameters: [
            new OA\Parameter(name: 'resource_id', description: 'Resource ID', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(response: 200, description: 'Everything is fine'),
            new OA\Response(response: 404, description: 'Not found'),
            new OA\Response(response: 500, description: 'Server error'),
        ]
    )]
    public function destroy(int $id,
                            DeleteResourceAction $action): JsonResponse
    {
        try {
            $action->execute($id);
        } catch (NotFoundException $exception) {
            return response()->json(['data' => null, 'errors' => $exception->getMessage()], 404);
        }
        return response()->json(['data' => null]);
    }

}
