<?php

namespace App\Orchid\Screens;

use App\Models\Department;
use App\Models\User;

use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;

class DepartmentEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Department Edit Screen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Department Edit Screen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Department $dep): array
    {
        return [
            "department" => $dep,
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
            Button::make('Create department')
                ->icon('pencil')
                ->method('createOrUpdate'),

                
            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate'),

                
            Button::make('remove')
                ->icon('trash')
                ->method('remove'),
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
                Input::make('department.title')
                    ->title('Title'),
                
                Quill::make('department.description')
                    ->title('description'),
                
                    
                Relation::make('department.director_id')
                    ->fromModel(User::class, 'name')
                    ->title('director'),
                // Input::make('department.title')
                //     ->title('Title'),
                
            ])
        ];
    }

    public function createOrUpdate(Department $dep, Request $request)
    {
        // dd($request->all());
        $request->validate([
            'department.title' => 'required',
            'department.description' => 'required',
            'department.director_id' => 'required',
        ]);

        $dep->fill($request->get('department'))->save();

        Alert::info('You have successfully created an post.');

        return redirect()->route('platform.department.list');
    }

    public function remove()
    {
        //todo
    }
}
