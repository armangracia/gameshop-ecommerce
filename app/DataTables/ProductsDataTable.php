<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'products.action')
            ->addColumn('action', function ($product) {
                return $product->id;
            })
            ->addColumn('action', function ($product) {
                $editBtn = '<a href="' . route('product.edit', $product->id) . '" class="btn btn-primary">Edit</a>';
                $deleteBtn = '<form action="' . route('product.destroy', $product->id) . '" method="POST" class="d-inline">
                                ' . method_field('DELETE') . '
                                ' . csrf_field() . '
                                <button type="submit" class="btn btn-danger">Delete</button>
                              </form>';
                return $editBtn . ' ' . $deleteBtn;
            })

            ->addColumn("created_at", function ($product) {
                return  date('F j, Y', strtotime($product->created_at));
            })
            ->addColumn("updated_at", function ($product) {
                return  date('F j, Y', strtotime($product->updated_at));
            })
           // ->setRowId('id');

           ->rawColumns(['action', 'images']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('products-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                  //  ->dom('Bfrtip')
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
            Column::make('name'),
            Column::make('slug'),
            Column::make('small_description'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(5)
            ->addClass('text-center'),
                 
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Products_' . date('YmdHis');
    }
}
