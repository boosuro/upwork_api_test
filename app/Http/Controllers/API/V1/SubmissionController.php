<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Jobs\SaveSubmissionJob;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\SubmissionResource;

class SubmissionController extends Controller
{
    
    /**
     * @OA\Post(
     *   path="/api/v1/submit",
     *   operationId="storeSubmission",
     *   summary="Store Submission",
     *   tags={"Submission"},
     *   description="Store Submission",
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="name",
     *                   description="Name",
     *                   type="string",
     *                   example="John Doe"
     *               ),
     *               @OA\Property(
     *                   property="email",
     *                   description="Email",
     *                   type="string",
     *                   example="john.doe@example.com"
     *               ),
     *               @OA\Property(
     *                   property="message",
     *                   description="Message",
     *                   type="string",
     *                   example="This is a test message."
     *               )       
     *         )
     *       )
     *   ),   
     *  @OA\Response(
     *      response=201, 
     *      description="submission received successfully",
     *      @OA\MediaType(
     *         mediaType="application/json",
     *      ),
     *   ),
     *   @OA\Response(
     *       response=403,
     *        description="Forbidden"
     *    )
     * ),
     * 
     * 
     * 
     * @author Boosuro Stephen <boosurostephen@yahoo.com>
     * 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function __invoke(Request $request){
        // Validate Request
        $validator = Validator::make($request->only('name', 'email', 'message'), [
            'name' => 'required|min:3|regex:/^([^0-9]*)$/',
            'email' => 'required|email|unique:submissions,email',
            'message' => 'required'
        ]);

        // Check if validation failed
        if ($validator->fails()) {
            return $this->sendErrorResponse($validator->errors(), 'Incomplete Data Provided', 422);
        }

        // Dispatch a Job
        dispatch(new SaveSubmissionJob($validator->validated()));

        return $this->sendSuccessResponse($validator->validated(), 'Submission Received', 201);
    }
}
