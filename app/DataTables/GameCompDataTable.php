<?php

namespace App\DataTables;

use App\Models\GameComp;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class GameCompDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', ('gamecomp.action') )
        ->addColumn('gamecomp', function($gamecomp){
            return $gamecomp->id;
        })
        ->addColumn('action', function ($gamecomp) {
            $editBtn = '<a href="' . route('gamecomp.edit', $gamecomp->id) . '" class="btn btn-primary">Edit</a>';
            $deleteBtn = '<form action="' . route('gamecomp.destroy', $gamecomp->id) . '" method="POST" class="d-inline">
                            ' . method_field('DELETE') . '
                            ' . csrf_field() . '
                            <button type="submit" class="btn btn-danger">Delete</button>
                          </form>';
            return $editBtn . ' ' . $deleteBtn;
        
        })
      

        ->addColumn("created_at", function ($gamecomp) {
            return  date('F j, Y', strtotime($gamecomp->created_at));
        })
        ->addColumn("updated_at", function ($gamecomp) {
            return  date('F j, Y', strtotime($gamecomp->updated_at));
        });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(GameComp $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('gamecomp-table')
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
            Column::make('id')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('name'),
            Column::make('slug'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'GameComp_' . date('YmdHis');
    }
}
