<?php

namespace App\DataTables;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SliderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', 'slider.action')
        ->addColumn('action', function ($slider) {
            return $slider->id;
        })
        ->addColumn('action', function ($slider) {
            $editBtn = '<a href="' . route('slider.edit', $slider->id) . '" class="btn btn-primary">Edit</a>';
            $deleteBtn = '<form action="' . route('slider.destroy', $slider->id) . '" method="POST" class="d-inline">
                            ' . method_field('DELETE') . '
                            ' . csrf_field() . '
                            <button type="submit" class="btn btn-danger">Delete</button>
                          </form>';
            return $editBtn . ' ' . $deleteBtn;
        })

        ->addColumn("created_at", function ($slider) {
            return  date('F j, Y', strtotime($slider->created_at));
        })
        ->addColumn("updated_at", function ($slider) {
            return  date('F j, Y', strtotime($slider->updated_at));
        })
       // ->setRowId('id');

       ->rawColumns(['action', 'images']);

    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Slider $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('slider-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('title'),
            Column::make('description'),
            Column::make('image'),
            Column::make('status'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
           
        ];
       
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Slider_' . date('YmdHis');
    }
}
