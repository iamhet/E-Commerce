<?php

namespace App\DataTables;

use App\Models\product_categories;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductCategoryDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return $this->getActionColumn($data);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ProductCategoryDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(product_categories $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('productcategorydatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->parameters([
                'searching' => true
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->title('ID'),
            Column::make('category_name')->title('CATEGORY NAME'),
            Column::make('action')->title('ACTION'),
        ];
    }

    protected function getActionColumn($data): string
    {
        $showUrl = route('admin.settings', $data->id);
        $editUrl = route('admin.settings', $data->id);
        return "<a class='waves-effect btn btn-primary' data-value='$data->id' href='$editUrl'><i class='fa fa-edit'></i></a>
                        <button class='btn btn-danger delete' data-value='$data->id' ><i class='fa fa-trash'></i></button>";
    }
    /**
     * Get filename for export.
     *
     * @return string
     */
    // protected function filename(): string
    // {
    //     return 'ProductCategory_' . date('YmdHis');
    // }
}
