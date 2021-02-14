<?php

namespace App\Orchid\Screens\StudentGroup;

use Orchid\Screen\Screen;

class StudentGroupStudentsListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'StudentGroupStudentsListScreen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'StudentGroupStudentsListScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [];
    }
}
