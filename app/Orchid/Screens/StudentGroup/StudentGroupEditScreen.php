<?php

namespace App\Orchid\Screens\StudentGroup;

use App\Models\StudentGroup;
use App\Models\Department;

use Illuminate\Http\Request;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;

class StudentGroupEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Список студенческих групп';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'StudentGroup Edit Screen';

    private $exist;
    /**
     * Query data.
     *
     * @return array
     */
    public function query(StudentGroup $sg): array
    {
        $this->exist = $sg->exists;
        return [
            "studentgroup" => $sg,
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
            Button::make("Создать")
                ->method("createOrUpdate")
                ->canSee(!$this->exist),

            Button::make("Изменить")
                ->method("createOrUpdate")
                ->canSee($this->exist),

            Button::make("Удалить")
                ->method("remove"),
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
                Input::make("studentgroup.article")
                    ->title("Номер группы")
                    ->required(),
                    
                Relation::make("studentgroup.department_id")
                    ->fromModel(Department::class, "title")
                    ->title("Кафедра")
                    ->required(),
            ])
        ];
    }

    public function createOrUpdate(StudentGroup $sg, Request $request)
    {
        $request->validate([
            "studentgroup.article" => "required",
            "studentgroup.department_id" => "required",
        ]);

        $sg->fill($request->get('studentgroup'))->save();


        return redirect()->route('platform.studentgroup.list');
    }
}
