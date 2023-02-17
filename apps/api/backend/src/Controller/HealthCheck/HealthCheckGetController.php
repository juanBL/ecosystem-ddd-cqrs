<?php

declare(strict_types=1);

namespace App\Apps\Api\Backend\Controller\HealthCheck;

use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class HealthCheckGetController
{
    /**
     * API health check endpoint must check anything that may interrupt the API from serving incoming requests.
     *
     * This call check all db connections.
     *
     * @OA\Response(
     *     response=200,
     *     description="All checks are OK"
     * )
     * @OA\Tag(name="Health Check")
     * @Security(name="Bearer")
     */
    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse(
            [
                'api-backend' => 'ok',
            ]
        );
    }
}
