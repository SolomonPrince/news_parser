<?php

namespace App\Orchid\Screens;

use App\Orchid\Layouts\LogsListLayout;
use App\Models\Log;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class LogListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Log List Screen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Log List Screen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return ["logs" =>  Log::paginate()];
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
        return [LogsListLayout::class];
    }
}
