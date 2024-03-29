<?php

namespace App\DataTables;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PostDataTable extends DataTable
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
            $html = ' <a href="'.route("admin.posts.edit",$row->id).'" class="btn btn-primary" title="Edit"><i class="fa fa-edit"></i></a>';
            $html .= '<a href="'.route("admin.posts.show",$row->id).'" class="btn btn-info" title="View"><i class="fa fa-file"></i></a>';
            $html .= '<a href="javascript:void(0);" class="btn btn-danger del_entity_form" title="Delete" item_id="'.$row->id.'" data-text="post"><i class="fa fa-trash"></i></a>';
            return $html;
        })->editColumn('name', function($row) {
          $nameHtml = '<p>'.$row->name.'</p>';
          $editHtml = $row->isEditing() ? '<p class="edit-context">Editing</p>' : '';
          $editor_name = (!empty($row->editor_name()) && $row->isEditing()) ? '<p class="edit-name">( '.$row->editor_name().' )</p>' : '';
          return $nameHtml.$editHtml.$editor_name;
      })->editColumn('created_at', function($row) {
        return date('d-m-Y',strtotime($row->created_at));
    })->editColumn('updated_at', function($row) {
        return date('d-m-Y',strtotime($row->updated_at));
    })->addColumn('user', function($row) {
        if (isset(request()->user) && !empty(request()->user)) {
            return '#'.$row->auther->id.' '.$row->auther->name;
        }else{

            return (!empty($row->auther))?'<a href="'.route('admin.posts.index').'?user='.$row->auther->id.'" target="_blank" style="color:#07509e">'.'#'.$row->auther->id.' '.$row->auther->name.'</a> : ':null;
        }
    })->addColumn('status', function($row) {
        $checked = "";
        if ($row->status == 1) {
         $checked = 'checked';
     }
     return '<input data-id="'.$row->id.'" class="toggle-class" type="checkbox" data-size="sm" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-url="'.route("admin.changeStatusPost").'" data-on="Active" data-off="InActive" '.$checked.'>';
 })->addColumn('del',function($row){
   return '<input type="checkbox" class="css-control-input mr-2 select-id" name="id[]" onchange="CustomSelectCheckboxSingle(this);" value="'.$row->id.'">';
})->rawColumns(['status','action','del','name','user']);
}

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Post $model): QueryBuilder
    {
        if (isset(request()->user) && !empty(request()->user)) {
            return $model->newQuery()->where('created_by',request()->user);
        }else{
            return $model->newQuery();
        }
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
        Column::make('name'),
        Column::make('user')->title('Created & Updated By'),
        Column::make('slug')->searchable(false)
        ->orderable(false)
        ->exportable(false)
        ->printable(false),
        Column::make('status'),
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
        return Post::count();
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
        return 'Post_' . date('YmdHis');
    }
}
