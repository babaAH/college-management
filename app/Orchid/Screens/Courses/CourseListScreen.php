<?php

namespace App\Orchid\Screens\Courses;

use \App\Models\Course;
use Orchid\Screen\Screen;

use App\Orchid\Layouts\CourseListLayout;

use Orchid\Screen\Actions\Link;

class CourseListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Список учебных дисциплин';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = '';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            "courses" => Course::paginate()
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
            
            Link::make("Создать учебную дисциплину")
                ->route('platform.course.edit'),

            Link::make("Редактировать учебную дисциплину")
                ->route('platform.course.edit')
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
            CourseListLayout::class
        ];
    }
}
