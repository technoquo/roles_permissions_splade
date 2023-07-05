<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use App\Tables\Cities;
use Illuminate\Http\Request;
use App\Forms\UpdateCityForm;
use App\Http\Requests\CreateCityRequest;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Select;
use ProtoneMedia\Splade\FormBuilder\Submit;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.cities.index', [
            'cities' => Cities::class
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $form = SpladeForm::make()
            ->action(route('admin.cities.store'))
            ->class('space-y-4 p-4 bg-white rounded')
            ->fields([
                Input::make('name')->label('Name'),
                Select::make('state_id')
                    ->label('Choose a State')
                    ->options(State::pluck('name', 'id')->toArray()),
                Submit::make()->label('Save')
            ]);

        return view('admin.cities.create', [
            'form' => $form
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCityRequest $request)
    {

        City::create($request->validated());
        Splade::toast('City created')->autoDismiss(3);
        return to_route('admin.cities.index');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {

        // $form = SpladeForm::make()
        //     ->action(route('admin.cities.update', $city))
        //     ->method('PUT')
        //     ->fields([
        //         Input::make('name')->label('Name'),
        //         Select::make('state_id')
        //             ->label('Choose a State')
        //             ->options(City::pluck('name', 'id')->toArray()),
        //         Submit::make()->label('Update')
        //     ])
        //     ->fill($city)
        //     ->class('space-y-4 p-4 bg-white rounded');


        // return view('admin.cities.edit', [
        //     'form' => $form
        // ]);

        return view('admin.cities.edit', [
            'form' => UpdateCityForm::make()->action(route('admin.cities.update', $city))->fill($city)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, City $city, UpdateCityForm $form)
    {
        $data = $form->validate($request);
        $city->update($data);
        Splade::toast('City updated')->autoDismiss(3);
        return to_route('admin.cities.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {

        $city->delete();
        Splade::toast('City deleted')->autoDismiss(3);
        return back();
    }
}
