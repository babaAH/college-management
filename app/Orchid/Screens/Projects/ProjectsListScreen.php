<?php

namespace App\Orchid\Screens\Projects;

use App\Models\Project;
use App\Orchid\Layouts\ProjectsListLayout;

use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;

class ProjectsListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Список проектов';

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
            "projects" => Project::paginate()
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
            Link::make("Создать проект")  
                ->route("platform.project.edit"),

                
            Link::make("Редактировать проект")  
                ->route("platform.project.edit"),

                
            Link::make("Удалить проект")  
                ->route("platform.project.edit"),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [ ProjectsListLayout::class ];
    }
}
