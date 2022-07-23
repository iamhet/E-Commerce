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
    public function query(product_categories $model)
    {
        $query = $model->newQuery();
        $gender = $this->request->get('gender');
        if(!empty($gender) || $gender != null){
            $gender_filter = [];
            if ($gender) {
                foreach ($gender as $key => $value) {
                    if (!empty($value) || $value!=null) {
                        if($value == 0){
                            $gender_filter[] = 'Men';
                        }
                        if($value == 1){
                            $gender_filter[] = 'Women';
                        }
                        if($value == 2){
                            $gender_filter[] = 'Kids';
                        }
                    }
                }
            }
            $query = $query->whereIn('gender',$gender_filter);
        }
        return $query;
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
            ->orderBy(1)
            ->parameters([
                'searching' => true,
                'buttons'      => ['reload','export', 'print', 'reset'],
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
            [
                'defaultContent' => '',
                'data'           => 'DT_RowIndex',
                'name'           => 'DT_RowIndex',
                'title'          => 'No',
                'render'         => null,
                'orderable'      => false,
                'searchable'     => false,
                'exportable'     => false,
                'printable'      => true,
                'footer'         => '',
            ],
            Column::make('category_name')->title('CATEGORY NAME'),
            Column::make('gender')->title('GENDER'),
            Column::make('action')->title('ACTION'),
        ];
    }

    protected function getActionColumn($data): string
    {
        $showUrl = route('admin.settings', $data->id);
        return "<button class='btn btn-info btn-sm editCategory' data-id='$data->id'><i class='fa fa-edit'></i></button>
                        <button class='btn btn-danger deleteCategory btn-sm' data-id='$data->id' ><i class='fa fa-trash'></i></button>";
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
