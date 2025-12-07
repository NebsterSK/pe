<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Planet;

class PlanetsTable extends DataTableComponent
{
    protected $model = Planet::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultPerPage(25);
        $this->setSearchLazy();
        $this->setTableAttributes([
            'class' => 'table table-striped table-bordered table-hover',
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->format(fn ($value) => number_format($value, 0, ',', ' '))
                ->sortable()
                ->searchable(),
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Diameter (km)", "diameter")
                ->format(fn ($value) => number_format($value, 0, ',', ' '))
                ->sortable()
                ->searchable(),
            Column::make("Rotation period (hour)", "rotation_period")
                ->format(fn ($value) => number_format($value, 0, ',', ' '))
                ->sortable()
                ->searchable(),
            Column::make("Orbital period (day)", "orbital_period")
                ->format(fn ($value) => number_format($value, 0, ',', ' '))
                ->sortable()
                ->searchable(),
            Column::make("Gravity", "gravity")
                ->sortable()
                ->searchable(),
            Column::make("Population", "population")
                ->format(fn ($value) => number_format($value, 0, ',', ' '))
                ->sortable()
                ->searchable(),
            Column::make("Climate", "climate")
                ->sortable()
                ->searchable(),
            Column::make("Terrain", "terrain")
                ->sortable()
                ->searchable(),
            Column::make("Surface water (%)", "surface_water")
                ->sortable()
                ->searchable(),
        ];
    }
}
