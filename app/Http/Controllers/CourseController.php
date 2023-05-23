<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateLessonRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
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
            $check = Course::query()->find($courseId);

            if ($check) {
                $validData = $request->validated();
                $validData['course_id'] = $courseId;
                $result = Lesson::query()->create(
                    $validData
                );
                return $this->jsonResponse(true, 'created', $result);
            } else {
                return $this->jsonResponse(false, 'course does\'nt exist.', [], 404);
            }

        } catch (Exception $e) {
            return $this->jsonResponse(false, 'error', $e, 409);
        }
    }

    public function updateCourseName(UpdateCourseRequest $request, $courseID)
    {
        try {
            $course = Course::query()->find($courseID);
            if ($course) {
                $course->name = $request->validated('name');
                $course->save();
                return $this->jsonResponse(true, 'updated.');
            } else {
                return $this->jsonResponse(false, 'course does\'nt exist.', [], 404);
            }
        } catch (Exception $e) {
            return $this->jsonResponse(false, 'error', $e, 409);
        }
    }
}
