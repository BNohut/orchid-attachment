<?php

namespace App\Orchid\Layouts;

use App\Models\Province;
use App\Models\State;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Matrix;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Listener;
use Orchid\Screen\Repository;
use Orchid\Support\Facades\Layout;

class TestListener extends Listener
{
    /**
     * List of field names for which values will be listened.
     *
     * @var string[]
     */
    protected $targets = ['order.prices', 'sum'];

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    protected function layouts(): iterable
    {
        return [
            Layout::rows([
                Input::make('sum')
                    ->id('sum')
                    ->title(__('Sum'))->disable(),
                Matrix::make('order.prices')
                    ->columns([
                        'Giá khác' => 'other_price',
                        'Ghi chú' => 'note',
                    ])->title(__('Giá khác'))
                    ->fields([
                        'other_price' => Input::make()
                            ->class('form-control new-price')
                            ->mask([
                                'alias' => 'integer',
                                'groupSeparator' => ',',
                                'suffix' => ' đ',
                                'allowMinus' => false,
                            ])->required(),
                        'note'   =>  Input::make()
                            ->type('text'),
                    ])
                    ->maxRows(10),
            ]),
            Layout::view('test')
        ];
    }

    /**
     * Update state
     *
     * @param \Orchid\Screen\Repository $repository
     * @param \Illuminate\Http\Request  $request
     *
     * @return \Orchid\Screen\Repository
     */
    public function handle(Repository $repository, Request $request): Repository
    {
        $other_prices = $request->input('order.prices');
        dd($other_prices);
        $sum = $request->get('sum');

        return $repository
            ->set('sum', $sum)
            ->set('prices', $other_prices);
    }
}
