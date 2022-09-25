<?php
use Illuminate\Http\Response;

function apiErrors($message = '', $statusCode = Response::HTTP_FORBIDDEN)
{
    return response()->json(['code' => Response::HTTP_FORBIDDEN, 'message' => $message], $statusCode);
}

function apiSuccess($data, $statusCode = Response::HTTP_OK)
{
    return response()->json(array_merge(['code' => Response::HTTP_OK], $data), $statusCode);
}
