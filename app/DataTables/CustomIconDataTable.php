<?php

namespace App\DataTables;

use App\Models\CustomIcon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CustomIconDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
         return (new EloquentDataTable($query))->addIndexColumn()->addColumn('action', function ($row) {
                    $html = '';
                    //$html .= '<a href="'.route("admin.country-zones.show",$row->id).'" class="btn btn-info" title="View"><i class="fa fa-file"></i></a>';
                    $html .= '<a href="javascript:void(0);" class="btn btn-danger del_entity_form" title="Delete" item_id="'.$row->id.'" data-text="custom icon"><i class="fa fa-trash"></i></a>';
                    return $html;
                })->editColumn('created_at', function($row) {
                    return (!empty($row->created_at))?date('d-m-Y',strtotime($row->created_at)):"";
                })->editColumn('updated_at', function($row) {
                    return (!empty($row->updated_at))?date('d-m-Y',strtotime($row->updated_at)):"";
                })->addColumn('uri',function($row){
                 return '<img src="'.$row->uri.'" width="60" height="60"/>';
            })->addColumn('del',function($row){
                 return '<input type="checkbox" class="css-control-input mr-2 select-id" name="id[]" onchange="CustomSelectCheckboxSingle(this);" value="'.$row->id.'">';
            })->rawColumns(['action','del','uri']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CustomIcon $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CustomIcon $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
         return $this->builder()
                    ->setTableId('touristbook-datatable')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(6)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ])->parameters($this->getParameters());
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
         return [
            Column::make('del')->title('<input type="checkbox" class="css-control-input mr-2 select-all text-center" onchange="CustomSelectCheckboxAll(this);" '.$this->disabledInput().'>')->searchable(false)
            ->orderable(false)
            ->exportable(false)
            ->printable(false)->width(5)
            ->addClass('text-center'),
            Column::make('loopIndex')->title('S.No.')->searchable(false)
            ->orderable(false)
            ->exportable(false)
            ->printable(false)->width(10)
            ->addClass('text-center'),
            Column::make('title'),
            Column::make('slug')->searchable(false)
            ->orderable(false)
            ->exportable(false)
            ->printable(false),
            Column::make('uri')->title('Icon'),
            Column::make('created_at')->title('Created'),
            Column::make('updated_at')->title('Updated'),
            Column::make('action')
            ->exportable(false)
            ->printable(false)
            ->width(120)
            ->addClass('text-center'),
        ];
    }


     /**
     * Get Parameters.
     *
     * @return array
     */

    public function getParameters(): array
    {
        return [
            'fnDrawCallback'=> 'function(){$(".toggle-class").bootstrapToggle()}',
            'paging' => true,
            'searching' => true,
            'info' => false,
        ];
    }

      /**
     * Get Status.
     *
     * @return bool
     */
    public function getCustomStatus(): bool
    {
        return CustomIcon::count();
    }

    /**
     * Get Disabled Status.
     *
     * @return string
     */
    public function disabledInput():string
    {


        $disabledInput = "";
        if (!$this->getCustomStatus()) {
            $disabledInput = "disabled";
        }
        return $disabledInput;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'CustomIcon_' . date('YmdHis');
    }
}
