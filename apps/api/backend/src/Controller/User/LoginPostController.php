<?php

declare(strict_types=1);

namespace App\Apps\Api\Backend\Controller\User;

use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Request;

final class LoginPostController
{
    /**
     * @OA\Tag(name="User")
     * @OA\Post(
     *     path="/login",
     *     summary="Logs user into system",
     *     operationId="loginUser",
     *     @OA\RequestBody(
     *         description="Create user login",
     *         required=true,
     *         @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="username",
     *                  description="Username",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="password",
     *                  description="Password",
     *                  type="string"
     *              )
     *          )
     *      )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="JWT token"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized JWT"
     *     )
     * )
     */
    public function __invoke(Request $request): void
    {
    }
}
