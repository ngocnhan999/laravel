<?php

namespace App\Services\Student\Abstracts;


use App\Models\Student;
use App\Repositories\Student\Interfaces\StudentImageInterface;
use Illuminate\Http\Request;

abstract class StoreStudentImageServiceAbstract
{
    /**
     * @var StudentImageInterface
     */
    protected $studentImageRepository;

    /**
     * StoreStudentImageServiceAbstract constructor.
     *
     * @param StudentImageInterface $studentImageRepository
     */
    public function __construct(
        StudentImageInterface $studentImageRepository
    )
    {
        $this->studentImageRepository = $studentImageRepository;
    }

    abstract public function execute(Request $request, Student $student, $fileName);
}
