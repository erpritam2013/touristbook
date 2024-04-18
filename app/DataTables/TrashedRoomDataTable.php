<?php

namespace App\DataTables;

use App\Models\Room;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TrashedRoomDataTable extends DataTable
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
                     $html = ' <a href="javascript:void(0);" class="btn btn-primary restore_entity_form" title="Restore" item_id="'.$row->id.'" data-text="room"><i class="fas fa-trash-restore"></i></a>';
                  
                    $html .= '<a href="javascript:void(0);" class="btn btn-danger del_permanent_entity_form" title="Permanent Delete" item_id="'.$row->id.'" data-text="room"><i class="fa fa-trash"></i></a>';
                    return $html;
                })->editColumn('created_at', function($row) {
                    return date('d-m-Y',strtotime($row->created_at));
                })->editColumn('hotel_id', function($row) {
                   // return (!empty($row->hotels))?$row->hotels->name:'';
                    $a_html = 'Hotel Not Selected'; 
                    if (!empty($row->hotels)) {
                        $a_html = '<a href="'.route('admin.hotels.edit',$row->hotels->id).'" class="btn btn-info" title="'.$row->hotels->name.'" target="_blank">'.$row->hotels->name.'</a>';
                    }
                    return $a_html;
                })->editColumn('updated_at', function($row) {
                    return date('d-m-Y',strtotime($row->updated_at));
                })->addColumn('address',function($row){
                    $hotelDetail = $row->detail;
                    return ($hotelDetail) ? $hotelDetail->map_address : '';
                })->addColumn('restore',function($row){
                 return '<input type="checkbox" class="css-control-input mr-2 select-id" name="id[]" onchange="CustomSelectCheckboxSingle(this);" value="'.$row->id.'" data-select_type="restore">';
            })->rawColumns(['action','restore','address','hotel_id']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Room $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Room $model): QueryBuilder
    {
        return $model->newQuery()->onlyTrashed();
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
            Column::make('restore')->title('<input type="checkbox" class="css-control-input mr-2 select-all text-center" onchange="CustomSelectCheckboxAll(this);" '.$this->disabledInput().' data-select_type="restore">')->searchable(false)
            ->orderable(false)
            ->exportable(false)
            ->printable(false)->width(5)
            ->addClass('text-center'),
            Column::make('loopIndex')->title('S.No.')->searchable(false)
            ->orderable(false)
            ->exportable(false)
            ->printable(false)->width(10)
            ->addClass('text-center'),
            Column::make('name'),
            Column::make('slug')->searchable(false)
            ->orderable(false)
            ->exportable(false)
            ->printable(false),
            Column::make('address'),
            Column::make('hotel_id')->title('Hotel'),
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
        return Room::count();
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
        return 'Room_' . date('YmdHis');
    }
}
