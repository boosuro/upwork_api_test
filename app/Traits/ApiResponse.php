<?php

namespace App\Traits;

trait ApiResponse
{

	public function sendSuccessResponse($data = [], $message = '', $status_code = 200)
	{
		return response()->json([
			'data' => $data,
			'message' => $message,
			'success' => true
		], $status_code);
	}

	public function sendErrorResponse($data = '', $message = '', $status_code = 500)
	{
		return response()->json([
			'data' => $data,
			'message' => $message,
			'error' => true
		], $status_code);
	}
}
