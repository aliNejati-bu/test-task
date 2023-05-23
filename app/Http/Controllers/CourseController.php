<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateLessonRequest;
use App\Models\Lesson;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class CourseController extends Controller
{
    private function jsonResponse($status, $message = null, $data = null, $code = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function createLesson(CreateLessonRequest $request, $courseId)
    {
        try {
            $validData = $request->validated();
            $validData['course_id'] = $courseId;
            $result = Lesson::query()->create(
                $validData
            );
            return $this->jsonResponse(true, 'created', $result);
        } catch (Exception $e) {
            return $this->jsonResponse(false, 'error', $e, 409);
        }

    }
}
