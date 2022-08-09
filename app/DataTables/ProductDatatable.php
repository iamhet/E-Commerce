<?php

namespace App\DataTables;

use App\Models\Products;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return $this->getActionColumn($data);
            })
            ->addColumn('images', function ($data) {
                return $this->getImageColumn($data);
            })
            ->rawColumns(['action', 'images']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ProductDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Products $model)
    {
        $query = $model->query()
            ->with(['productImages', 'productCategories'])
            ->newQuery();
        $gender = $this->request->get('gender');
        $category = $this->request->get('category');

        if ((!empty($gender) || $gender != null) && $gender != 0) {
            if ($gender) {
                if (!empty($gender) || $gender != null) {
                    if ($gender == 1) {
                        $gender_filter = 'Men';
                    }
                    if ($gender == 2) {
                        $gender_filter = 'Women';
                    }
                    if ($gender == 3) {
                        $gender_filter = 'Kids';
                    }
                }
                $query = $query->whereRelation('productCategories', 'gender', '=', $gender_filter);

            }
        }
        if ((!empty($category) || $category != null) && $category != 0) {
            if ($category) {
                $query = $query->whereRelation('productCategories', 'category_name', '=', $category);
            }
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
            ->setTableId('productsdatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->parameters([
                'searching' => true,
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
            Column::make('product_name', 'product_name')->title('PRODUCT NAME'),
            Column::make('product_price', 'product_price')->title('PRICE'),
            Column::make('product_categories.category_name', 'productCategories.category_name')->title('CATEGORY'),
            Column::make('product_categories.gender', 'productCategories.gender')->title('GENDER'),
            Column::make('images')->title('IMAGES'),
            Column::make('action')->title('ACTION'),
        ];
    }

    protected function getActionColumn($data): string
    {
        return "<button class='btn btn-info btn-sm editCategory' data-id='$data->id'><i class='fa fa-edit'></i></button>
                        <button class='btn btn-danger deleteCategory btn-sm' data-id='$data->id' ><i class='fa fa-trash'></i></button>";
    }
    protected function getImageColumn($data): string
    {
        $image = '';
        foreach ($data->productImages as $key => $value) {
            $image .= "<img class='inline' src=" . asset('ProductImages/' . $data->id . '/' . $value->product_image) . " width='50px' height='50px'>";
        }

        return $image;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    // protected function filename()
    // {
    //     return 'Product_' . date('YmdHis');
    // }
}
