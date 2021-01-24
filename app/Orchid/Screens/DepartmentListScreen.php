<?php

namespace App\Orchid\Screens;

use App\Models\Department;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

use App\Orchid\Layouts\DepartmentListLayout;

class DepartmentListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Список кафедр';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Department List Screen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'departments' => Department::paginate(),
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
            Link::make('Create new')
                ->icon('pencil')
                ->route('platform.department.edit'),
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
            DepartmentListLayout::class
        ];
    }
}
