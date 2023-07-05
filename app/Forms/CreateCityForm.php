<?php

namespace App\Forms;

use App\Models\State;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\AbstractForm;
use ProtoneMedia\Splade\FormBuilder\Text;
use ProtoneMedia\Splade\FormBuilder\Select;
use ProtoneMedia\Splade\FormBuilder\Submit;

class CreateCityForm extends AbstractForm
{
    public function configure(SpladeForm $form)
    {
        $form
            ->action(route('admin.cities.store'))
            ->method('POST')
            ->class('space-y-4 p-4 bg-white rounded')
            ->fill([
                //
            ]);
    }

    public function fields(): array
    {
        return [
            Text::make('name')
                ->label(__('Name'))
                ->rules(['required', 'max:100', 'min:3']),
            Select::make('state_id')
                ->label('Choose a state')
                ->options(State::pluck('name', 'id')->toArray())
                ->rules(['required']),
            Submit::make()
                ->label(__('Save'))
        ];
    }
}
