<?php

namespace App\Orchid\Layouts;

use App\Models\User;
use App\Models\Department;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class DepartmentListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'departments';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make("title", "Title")
                ->render(function (Department $department){
                    return Link::make($department->title)
                        ->route('platform.department.edit', $department);
                }),

            TD::make("director_id", "Заведующий")
                ->render(function (Department $department){
                    $director = User::where("id", $department->director_id)->first();
                    return Link::make($director->name)
                        ->route('platform.systems.users', $director);
                }),

            TD::make('created_at', 'create_at'),
            TD::make('updated_at', 'updated_at'),
        ];
    }
}
