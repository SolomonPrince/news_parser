<?php

namespace App\Orchid\Screens;

use App\Models\Log;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class LogViewScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Log View Screen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Log View Screen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Log $log): array
    {
        return ['log' => $log];
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
        return [
            Layout::rows([
                Input::make('log.request_method')
                    ->title('Request Method')
                    ->disabled(),
                Input::make('log.request_url')
                    ->title('Request URL')
                    ->disabled(),
                Input::make('log.response_code')
                    ->title('Response code')
                    ->disabled(),
                DateTimer::make('log.created_at')
                    ->title('Date')
                    ->disabled(),

                TextArea::make('log.response_body')
                    ->title('Response Body')
                    ->rows(30)
                    ->disabled(),
            ])
        ];
    }
}
