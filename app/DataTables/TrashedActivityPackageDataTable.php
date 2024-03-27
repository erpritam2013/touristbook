<?php

namespace App\DataTables;

use App\Models\ActivityPackage;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TrashedActivityPackageDataTable extends DataTable
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
                    $html = ' <a href="javascript:void(0);" class="btn btn-primary restore_entity_form" title="Restore" item_id="'.$row->id.'" data-text="activity package"><i class="fas fa-trash-restore"></i></a>';
                  
                    $html .= '<a href="javascript:void(0);" class="btn btn-danger del_permanent_entity_form" title="Permanent Delete" item_id="'.$row->id.'" data-text="activity package"><i class="fa fa-trash"></i></a>';
                    return $html;
                })->editColumn('title', function($row) {
                    $nameHtml = '<p>'.$row->title.'</p>';
                    $editHtml = $row->isEditing() ? '<p class="edit-context">Editing</p>' : '';
                    $editor_name = (!empty($row->editor_name()) && $row->isEditing()) ? '<p class="edit-name">( '.$row->editor_name().' )</p>' : '';
                    return $nameHtml.$editHtml.$editor_name;
                })->editColumn('created_at', function($row) {
                    return date('d-m-Y',strtotime($row->created_at));
                })->editColumn('updated_at', function($row) {
                    return date('d-m-Y',strtotime($row->updated_at));
                })->addColumn('user', function($row) {
                       if (!empty($row->user)) {
                        return '#'.$row->user->id.' '.$row->user->name;
                    }
                })->addColumn('activity', function($row) {
                    $a_html = ''; 
                    if (!empty($row->activity_list)) {
                        $a_html .= '<a href="'.route('admin.activities.edit',$row->activity_list[0]->id).'" class="btn btn-info" title="'.$row->activity_list[0]->name.'" target="_blank">'.$row->activity_list[0]->name.'</a>';
                    }
                    return $a_html;
                })->addColumn('restore',function($row){
                 return '<input type="checkbox" class="css-control-input mr-2 select-id" name="id[]" onchange="CustomSelectCheckboxSingle(this);" value="'.$row->id.'" data-select_type="restore">';
            })->rawColumns(['action','restore','activity','title','user']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ActivityPackage $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ActivityPackage $model): QueryBuilder
    {
        return $model->newQuery()->select(['id','title','slug','status','created_at','updated_at','created_by','editor_id','is_editing','editing_expiry_time'])->onlyTrashed();
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
                    ->orderBy(1)
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
            Column::make('title'),
             Column::make('user')->title('Created & Updated By'),
            Column::make('slug')->searchable(false)
            ->orderable(false)
            ->exportable(false)
            ->printable(false),
            Column::make('activity'),
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
        return ActivityPackage::count();
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
        return 'ActivityPackage_' . date('YmdHis');
    }
}
