<?php

namespace App\DataTables;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', ('category.action') )
            ->addColumn('categories', function($category){
                return $category->id;
            })
            ->addColumn('action', function ($category) {
                $editBtn = '<a href="' . route('category.edit', $category->id) . '" class="btn btn-primary">Edit</a>';
                $deleteBtn = '<form action="' . route('category.destroy', $category->id) . '" method="POST" class="d-inline">
                                ' . method_field('DELETE') . '
                                ' . csrf_field() . '
                                <button type="submit" class="btn btn-danger">Delete</button>
                              </form>';
                return $editBtn . ' ' . $deleteBtn;
            
            })
            ->rawColumns(['action', 'images'])

            ->addColumn("created_at", function ($category) {
                return  date('F j, Y', strtotime($category->created_at));
            })
            ->addColumn("updated_at", function ($category) {
                return  date('F j, Y', strtotime($category->updated_at));
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Category $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('category-table')
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
            Column::make('slug'),
            Column::make('description'),
            Column::make('meta_title'),
            Column::make('meta_description'),
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
        return 'Category_' . date('YmdHis');
    }
}
