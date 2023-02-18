<?php

namespace App\DataTables;

use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PermissionDatatable extends DataTable
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
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\PermissionDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Permission $permission)
    {
        return $permission->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('permissiondatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
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
            Column::make('name'),
            Column::make('action')->title('Action')
        ];
    }
    protected function getActionColumn($data): string
    {
        return "<button class='btn btn-info btn-sm editPermission' data-id='$data->id'><i class='fa fa-edit'></i></button>
            <button class='btn btn-danger deletePermission btn-sm' data-id='$data->id' ><i class='fa fa-trash'></i></button>";
    }
    /**
     * Get filename for export.
     *
     * @return string
     */
}
