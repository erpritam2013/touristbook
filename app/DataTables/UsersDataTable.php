<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
       return (new EloquentDataTable($query))->addIndexColumn()->addColumn('icon',function($row){
                return get_fontawesome_icon_html($row->icon,'fa-lg');
            })->addColumn('action', function ($row) {
                    $html = ' <a href="'.route("admin.users.edit",$row->id).'" class="btn btn-primary" title="Edit"><i class="fa fa-edit"></i></a>';
                    $html .= '<a href="'.route("admin.users.show",$row->id).'" class="btn btn-info" title="View"><i class="fa fa-file"></i></a>';
                    $html .= '<a href="javascript:void(0);" class="btn btn-danger del_entity_form" title="Delete" item_id="'.$row->id.'" data-text="place"><i class="fa fa-trash"></i></a>';
                    return $html;
                })->editColumn('created_at', function($row) {
                    return date('d-m-Y',strtotime($row->created_at));
                })->editColumn('updated_at', function($row) {
                    return date('d-m-Y',strtotime($row->updated_at));
                })->addColumn('asign-data', function($row) {
                    if ($row->role == 'admin' || $row->role == 'editor') {
                    return '<a href="'.route("admin.user.userAsgin",$row->id).'" class="btn btn-info" title="Asign data to click here"><i class="fa fa-file"></i> Asign Data</a>';
                       
                    }
                })->addColumn('is_active', function($row) {
                    $checked = "";
                    if ($row->is_active == 1) {
                       $checked = 'checked';
                    }
                    return '<input data-id="'.$row->id.'" class="toggle-class" type="checkbox" data-size="sm" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-url="'.route("admin.users.changeStatus").'" data-on="Active" data-off="InActive" '.$checked.'>';
                })->addColumn('del',function($row){
                 return '<input type="checkbox" class="css-control-input mr-2 select-id" name="id[]" onchange="CustomSelectCheckboxSingle(this);" value="'.$row->id.'">';
            })->rawColumns(['is_active','action','del','asign-data']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery()->whereNot('id',auth()->user()->id);
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
                    ->orderBy(5)
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
            Column::make('del')->title('<input type="checkbox" class="css-control-input mr-2 select-all text-center" onchange="CustomSelectCheckboxAll(this);" '.$this->disabledInput().'>'
            )->searchable(false)
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
            Column::make('email')->title('Email')->searchable(false)
            ->orderable(true)
            ->exportable(false)
            ->printable(false),
            Column::make('role'),
            Column::make('asign-data'),
            Column::make('is_active')->title("Status"),
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
     * Get User Status.
     *
     * @return bool
     */
    public function getCustomStatus(): bool
    {
        return User::count();
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
        return 'User_' . date('YmdHis');
    }
}
