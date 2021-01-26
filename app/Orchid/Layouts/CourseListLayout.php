<?php

namespace App\Orchid\Layouts;

use \App\Models\Course;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CourseListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'courses';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make("name", "Название дисциплины")
                ->render(function (Course $course){
                    return Link::make($course->name)
                        ->route('platform.course.edit', $course);
                }),

            TD::make("session_of_the_started_to_teaching", "Семестр")
                ->render(function (Course $course){
                    return Link::make($course->session_of_the_started_to_teaching)
                        ->route('platform.course.edit', $course);
                }),

            TD::make('created_at', 'Последнее редактировани'),
            TD::make('updated_at', 'Дата и время создания'),
        ];
    }
}
