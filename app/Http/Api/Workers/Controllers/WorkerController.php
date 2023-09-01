<?php

namespace App\Http\Api\Workers\Controllers;

use App\Domain\Workers\Actions\ChangeWorkerAction;
use App\Domain\Workers\Actions\CreateWorkerAction;
use App\Domain\Workers\Actions\DeleteWorkerAction;
use App\Domain\Workers\Actions\GetAllWorkerAction;
use App\Domain\Workers\Actions\GetWorkerAction;
use App\Domain\Workers\Actions\UpdateWorkerAction;
use App\Domain\Workers\Models\Worker;
use App\Exceptions\NotFoundException;
use App\Http\Api\Workers\Requests\ChangeWorkerRequest;
use App\Http\Api\Workers\Requests\CreateWorkerRequest;
use App\Http\Api\Workers\Requests\UpdateWorkerRequest;
use App\Http\Api\Workers\Resources\AllWorkerResources;
use App\Http\Api\Workers\Resources\WorkerResource;
use App\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

class WorkerController extends Controller
{
    #[OA\Get(
        path: '/api/workers',
        operationId: 'getAllWorkers',
        summary: 'Get all workers',
        tags: ['Worker'],
        responses: [
            new OA\Response(response: 200, description: 'Everything is fine'),
            new OA\Response(response: 500, description: 'Server error'),
        ]
    )]
    public function index(GetAllWorkerAction $action): AllWorkerResources
    {
        $worker = $action->execute();
        return new AllWorkerResources($worker);
    }

    #[OA\Post(
        path: '/api/workers',
        operationId: 'postWorker',
        summary: 'Post Worker',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(example: [
                'name' => 'Ivan Ivanov',
                'age' => 33,
                'company_id' => 3
            ])
        ),
        tags: ['Worker'],
        responses: [
            new OA\Response(response: 201, description: 'Everything is fine'),
            new OA\Response(response: 400, description: 'Bad request'),
            new OA\Response(response: 500, description: 'Server error'),
        ]
    )]
    public function store(CreateWorkerAction $action,
                          CreateWorkerRequest $request): WorkerResource|JsonResponse
    {
        $worker = $action->execute($request->validated());
        if (!$worker) {
            return response()->json(['data' => 'Bad request'], 400);
        }
        return new WorkerResource($worker);
    }

    #[OA\Get(
        path: '/api/workers/{worker_id}',
        operationId: 'getWorker',
        summary: 'Get Worker by id',
        tags: ['Worker'],
        parameters: [
            new OA\Parameter(name: 'worker_id', description: 'Worker ID', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(response: 200, description: 'Everything is fine'),
            new OA\Response(response: 404, description: 'Not found'),
            new OA\Response(response: 500, description: 'Server error'),
        ]
    )]
    public function show(int $id, GetWorkerAction $action): WorkerResource|JsonResponse
    {
        try {
            $worker = $action->execute($id);
        } catch (NotFoundException $exception) {
            return response()->json(['data' => null, 'errors' => $exception->getMessage()], 404);
        }
        if (!$worker) {
            return response()->json(['data' => 'Bad request'], 400);
        }
        return new WorkerResource($worker);
    }

    #[OA\Patch(
        path: '/api/workers/{worker_id}',
        operationId: 'changeWorker',
        summary: 'Change Worker by id',
        requestBody: new OA\RequestBody(
            required: false,
            content: new OA\JsonContent(example: [
                'name' => 'Ivan Ivanov',
                'age' => 33,
                'company_id' => 3
            ])
        ),
        tags: ['Worker'],
        parameters: [
            new OA\Parameter(name: 'worker_id', description: 'Worker ID', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(response: 200, description: 'Everything is fine'),
            new OA\Response(response: 400, description: 'Bad request'),
            new OA\Response(response: 404, description: 'Not found'),
            new OA\Response(response: 500, description: 'Server error'),
        ]
    )]
    public function change(ChangeWorkerRequest $request,
                           ChangeWorkerAction $action, int $id): WorkerResource|JsonResponse
    {
        try {
            $worker = $action->execute($id, $request->validated());
        } catch (NotFoundException $exception) {
            return response()->json(['data' => null, 'errors' => $exception->getMessage()], 404);
        }
        if (!$worker) {
            return response()->json(['data' => 'Bad request'], 400);
        }
        return new WorkerResource($worker);
    }

    #[OA\Put(
        path: '/api/workers/{worker_id}',
        operationId: 'updateWorker',
        summary: 'Update Worker by id',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(example: [
                'name' => 'Ivan Ivanov',
                'age' => 33,
                'company_id' => 3
            ])
        ),
        tags: ['Worker'],
        parameters: [
            new OA\Parameter(name: 'worker_id', description: 'Worker ID', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(response: 200, description: 'Everything is fine'),
            new OA\Response(response: 400, description: 'Bad request'),
            new OA\Response(response: 404, description: 'Not found'),
            new OA\Response(response: 500, description: 'Server error'),
        ]
    )]
    public function update(UpdateWorkerRequest $request,
                           UpdateWorkerAction $action, int $id): WorkerResource|JsonResponse
    {
        try {
            $worker = $action->execute($id, $request->validated());
        } catch (NotFoundException $exception) {
            return response()->json(['data' => null, 'errors' => $exception->getMessage()], 404);
        }
        if (!$worker) {
            return response()->json(['data' => 'Bad request'], 400);
        }
        return new WorkerResource($worker);
    }

    #[OA\Delete(
        path: '/api/workers/{worker_id}',
        operationId: 'deleteWorker',
        summary: 'Delete worker by id',
        tags: ['Worker'],
        parameters: [
            new OA\Parameter(name: 'worker_id', description: 'Worker ID', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(response: 200, description: 'Everything is fine'),
            new OA\Response(response: 404, description: 'Not found'),
            new OA\Response(response: 500, description: 'Server error'),
        ]
    )]
    public function destroy(int $id,
                            DeleteWorkerAction $action): JsonResponse
    {
        try {
            $action->execute($id);
        } catch (NotFoundException $exception) {
            return response()->json(['data' => null, 'errors' => $exception->getMessage()], 404);
        }
        return response()->json(['data' => null]);
    }
}
