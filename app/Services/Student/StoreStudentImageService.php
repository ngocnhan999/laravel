<?php

namespace App\Services\Student;

use App\Models\Student;
use App\Services\Student\Abstracts\StoreStudentImageServiceAbstract;
use Illuminate\Http\Request;

class StoreStudentImageService extends StoreStudentImageServiceAbstract
{
    /**
     * @param Request $request
     * @param Student $student
     * @param $fileName
     */
    public function execute(
        Request $request,
        Student $student,
        $fileName
    )
    {
        return $this->studentImageRepository->createOrUpdate([
            'imageable_id'   => $student->id,
            'imageable_type' => Student::class,
            'image'          => $fileName,
            'type'           => $request->input('type')
        ]);
    }
}
