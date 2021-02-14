<?php

namespace App\Orchid\Screens\StudentGroup;

use App\Models\User;
use Orchid\Screen\Screen;
use App\Models\Department;

use App\Models\StudentGroup;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Relation;
use Orchid\Support\Facades\Layout;
use Illuminate\Support\Facades\Redirect;

use App\Orchid\Layouts\StudentGroupStudentsListLayout;

class StudentGroupEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Данные студенческой групп';

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
    public function query(Request $req, $studentgroup): array
    {
        // dd($req->studentgroup);
        $sg = StudentGroup::where("id", $req->studentgroup)->first();
        // $this->exist = $sg->exists;
        if(!$sg)
            return abort(404);//\Redirect::to('404');
        $this->exist = true;
        $students = $sg->students()->get();
        // dd($students);
        return [
            "studentgroup" => $sg,
            "students"     => $students,
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

            Link::make("К списку групп")
                ->route("platform.studentgroup.list"),
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

                Relation::make("studentgroup.students")
                    ->fromModel(User::class, "name")
                    ->applyScope('isStudent')
                    ->title("Студенты")
                    ->multiple()
                    ->required(),
            ]),
            StudentGroupStudentsListLayout::class
        ];
    }

    public function createOrUpdate(StudentGroup $sg, Request $request)
    {
        $request->validate([
            "studentgroup.article" => "required",
            "studentgroup.department_id" => "required",
        ]);

        $sg->fill($request->get('studentgroup'))->save();
        $sg->students()->detach();
        $students = ($request->all())["studentgroup"]["students"];
        $sg->students()->attach($students);


        return redirect()->route('platform.studentgroup.list');
    }
}
