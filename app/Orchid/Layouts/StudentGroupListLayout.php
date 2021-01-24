<?php

namespace App\Orchid\Layouts;

use App\Models\StudentGroup;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class StudentGroupListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'student_groups';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make("id", "id")
                ->render(function(StudentGroup $sg){
                    return Link::make($sg->id)
                        ->route('platform.studentgroup.edit', $sg);
                }),
            TD::make("article", "Номер группы")
                ->render(function(StudentGroup $sg){
                    return Link::make($sg->article)
                        ->route('platform.studentgroup.edit', $sg);
                }),
            TD::make("created_at", "Создана"),
        ];
    }
}
