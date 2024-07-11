<?php

namespace App\DataTables;

use App\Models\Test;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TestDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'test.action')
            ->addColumn('question', function (Test $test) {
                return '<p>'.$test->questions->count().' ข้อ</p>';
            })
            ->addColumn('course', function (Test $test) {
                return '<p>'.$test->course->name.'</p>';
            })
            ->addColumn('action', function($query){
                $editBtn = "<a href='".route('teacher.tests.edit', ['test' => $query->id, 'course' => request()->query('course')])."' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='' class='btn btn-danger delete-item' ><i class='far fa-trash-alt'></i></a>";
    
                // $moreBtn = '<div class="btn-group dropstart" style="margin-left:3px">
                //     <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                //     <i class="fas fa-cog"></i>
                //     </button>
                //     <ul class="dropdown-menu">
                //         <li><a class="dropdown-item has-icon" href="'.route('teacher.lesson.index', ['course' => $query->id]).'"> View Lessons</a></li>
                //         <li><a class="dropdown-item has-icon" href=""> Variants</a></li>
                //     </ul>
                // </div>';
    
                // return $editBtn.$deleteBtn.$moreBtn;
                return $editBtn.$deleteBtn;
            })
            ->rawColumns(['question', 'course', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Test $model): QueryBuilder
    {
        // กรองเฉพาะ tests ที่เป็นของ course ที่ส่งมาจาก CourseDataTable
        return $model->newQuery()->where('course_id', request()->query('course'));
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('test-table')
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
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->width(30),
            Column::make('name')->title('ชื่อแบบทดสอบ')->width(100), 
            Column::make('question')->title('จำนวนคำถาม')->width(100), 
            Column::make('course')->title('คอร์ส')->width(50), 
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Test_' . date('YmdHis');
    }
}
