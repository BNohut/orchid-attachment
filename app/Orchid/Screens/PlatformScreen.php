<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class PlatformScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Get Started For Upload Image';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'Welcome to our tutorial on how to upload an image in Laravel using Orchid Platform. We will guide you through the process of uploading an image and displaying it on the screen. Let\'s get started!';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Create User')
                ->route('platform.systems.users.create')
                ->class('btn btn-success rounded')
                ->icon('cloud-upload')
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [];
    }
}
