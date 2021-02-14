<?php

namespace App\Orchid\Screens\Projects;

use Illuminate\Http\Request;

use App\Models\Project;
use App\Models\User;
use App\Models\Course;

use Orchid\Screen\Screen;


use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\CheckBox;

use Orchid\Support\Facades\Layout;

class ProjectsEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Редактирование проектов';

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
    public function query(Project $project): array
    {
        $this->exist = $project->exists;
        return [
            "project" => $project
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
            Button::make("Создать проект")  
                ->method("createOrUpdate")
                ->canSee(!$this->exist),

                
            Button::make("Редактировать проект")  
                ->method("createOrUpdate")
                ->canSee($this->exist),

                
            Button::make("Удалить проект")  
                ->method("createOrUpdate")
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
                CheckBox::make('project.active')
                    ->title("Активен")
                    ->sendTrueOrFalse(),

                Relation::make("project.course_id")
                    ->fromModel(Course::class, 'name')
                    ->title("На какой дисциплине читается"),

                Relation::make("project.user_id")
                    ->fromModel(User::class, 'name')
                    ->applyScope("isStudent")
                    ->title("Выполняет студент"),

                Input::make("project.title")
                    ->title("Название проекта")
                    ->required(),

                Quill::make("project.description")
                    ->title("Описание проекта")
                    ->required(),
            ])
        ];
    }

    public function createOrUpdate(Project $project, Request $request)
    {
        $request->validate([
            'project.active'      => 'required|boolean',
            'project.title'       => 'required|string|max:190',
            'project.description' => 'required',
            // 'project.course_id' => 'required',
            // 'project.user_id' => 'required',
        ]);

        $project->fill($request->get("project"))->save();

        return redirect()->route('platform.project.list');
    }
}
