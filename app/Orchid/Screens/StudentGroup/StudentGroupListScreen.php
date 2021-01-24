<?php

namespace App\Orchid\Screens\StudentGroup;

use App\Models\StudentGroup;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

use App\Orchid\Layouts\StudentGroupListLayout;


class StudentGroupListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'StudentGroup List Screen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'StudentGroup List Screen';

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
            "student_groups" => StudentGroup::paginate(),
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
                ->route('platform.studentgroup.edit')
                ->canSee(!$this->exist),

            Link::make('Update')
                ->icon('pencil')
                ->route('platform.studentgroup.edit')
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
            StudentGroupListLayout::class
        ];
    }
}
