<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     description="Avangardist.pro Swagger OpenApi.  You can find out more about Avangardist.pro at [https://avangardist.pro](https://avangardist.pro).",
 *     version="1.0.0",
 *     title="Avangardist.pro OpenApi",
 *     termsOfService="https://avangardist.pro/avangardist/terms-of-service",
 *     @OA\Contact(
 *         email="demid@avangardist.pro"
 *     ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 * @OA\Schemes(format="http")
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      in="header",
 *      name="bearerAuth",
 *      type="http",
 *      scheme="bearer",
 *      bearerFormat="JWT",
 * )
 * @OA\Tag(
 *     name="Auth",
 *     description="Authentication",
 * )
 * @OA\Tag(
 *     name="User",
 *     description="User data handling",
 * )
 * @OA\Tag(
 *     name="Admin",
 *     description="Dashboard. Admin authorized only.",
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
