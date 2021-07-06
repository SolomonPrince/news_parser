<?php

namespace App\Orchid\Screens;

use App\Models\News;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Fields\Select;


class NewsEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'News Edit Screen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'News Edit Screen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(News $news): array
    {
        return ['news' => $news];
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
                Input::make('news.title')
                    ->title('Title')
                    ->disabled(),
                Input::make('news.link')
                    ->title('Link')
                    ->disabled(),
                Input::make('news.author')
                    ->title('Author')
                    ->disabled(),
                DateTimer::make('news.publication_date')
                    ->title('Publication date')
                    ->disabled(),
                TextArea::make('news.description')
                    ->title('Description')
                    ->rows(3)
                    ->disabled(),
                
            ])
        ];
    }
}
