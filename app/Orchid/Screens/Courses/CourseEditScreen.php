<?php

namespace App\Orchid\Screens\Courses;

use Illuminate\Http\Request;

use \App\Models\Course;
use Orchid\Screen\Screen;

use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;

use Orchid\Support\Facades\Layout;

class CourseEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Course Edit Screen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Course Edit Screen';


    private $exist = false;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Course $course): array
    {
        $this->exist = $course->exists;
        return [
            'course' => $course,
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make("Создать учебную дисциплину")
                ->method("updateOrCreate")
                ->canSee(!$this->exist),

            Button::make("Редактировать учебную дисциплину")
                ->method("updateOrCreate")
                ->canSee($this->exist),
            
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make("course.session_of_the_started_to_teaching")
                    ->type('number')
                    ->title("На каком семестре читается")
                    ->required(),
            
                Input::make("course.name")
                    ->title("Название курса")
                    ->required(),
            ]),
        ];
    }

    public function updateOrCreate(Course $course, Request $request)
    {
        $request->validate([
            "course.session_of_the_started_to_teaching" => "required|integer|min:1",
            "course.name" => "required",
        ]);

        $course->fill($request->get('course'))->save();


        return redirect()->route('platform.course.list');
    }
}
