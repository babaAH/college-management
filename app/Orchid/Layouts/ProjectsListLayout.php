<?php

namespace App\Orchid\Layouts;

use App\Models\Project;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

use Orchid\Screen\Actions\Link;


class ProjectsListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'projects';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make("title", "Название")
                ->render(function(Project $project){
                    return Link::make($project->title)
                        ->route("platform.project.edit", $project);
                }),
        ];
    }
}
