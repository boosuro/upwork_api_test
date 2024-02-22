<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


/**
 * @OA\Info(
 *   version="1.0.0",
 *   title="Upwork API Test",
 *   description="This is a demonstration of Upwork Submission test as part of proposal submited by Boosuro Stephen",
 *   @OA\Contact(
 *      email="boosurostephen@yahoo.com",
 *      url="https://boosurostephen.com/my-portfolio",
 *      name="Developer"
 *   ),
 *   @OA\License(
 *      name="Apache 2.0",
 *      url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *   )
 * ),
 * @OA\Server(
 *   url=L5_SWAGGER_CONST_HOST,
 *   description="PHP TEST API Server" 
 * )
 */


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, ApiResponse;
}
