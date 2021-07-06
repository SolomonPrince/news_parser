<?php

namespace App\Orchid\Screens;

use App\Orchid\Layouts\NewsListLayout;
use App\Models\News;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class NewsListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'News List Screen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'News List Screen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return ['all_news' => News::paginate()];
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
        return [NewsListLayout::class];
    }
}
