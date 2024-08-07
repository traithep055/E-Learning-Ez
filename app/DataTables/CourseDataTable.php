<?php

namespace App\DataTables;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CourseDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'course.action')
            ->addColumn('image', function ($query) {
                return "<img width='60px' src='".asset($query->image)."'>";
            })
            // ->addColumn('type', function ($query) {
            //     switch ($query->course_type) {
            //         case 'new_arrival':
            //             return '<i class="badge bg-success">New Arrival</i>';
            //             break;
            //         case 'top_course':
            //             return '<i class="badge bg-info text-dark">Top Course</i>';
            //             break;
                    
            //         default:
            //             return '<i class="badge bg-dark">None</i>';
            //             break;
            //     }
            // })
            ->addColumn('status', function ($query) {
                if ($query->status == 1) {
                    $button = '<div class="form-check form-switch">
                    <input checked class="form-check-input change-status" type="checkbox" id="flexSwitchCheckDefault" data-id="'.$query->id.'">
                  </div>';
                } else {
                    $button = '<div class="form-check form-switch">
                    <input class="form-check-input change-status" type="checkbox" id="flexSwitchCheckDefault" data-id="'.$query->id.'">
                  </div>';
                }
                return $button;
            })
            ->addColumn('action', function($query){
                $editBtn = "<a href='".route('teacher.courses.edit', $query->id)."' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='".route('teacher.courses.destroy', $query->id)."' class='btn btn-danger delete-item' ><i class='far fa-trash-alt'></i></a>";
    
                $moreBtn = '<div class="btn-group dropstart" style="margin-left:3px">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-cog"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item has-icon" href="'.route('teacher.lesson.index', ['course' => $query->id]).'"> บทเรียน</a></li>
                        <li><a class="dropdown-item has-icon" href="'.route('teacher.tests.index', ['course' => $query->id]).'"> แบบทดสอบ</a></li>
                    </ul>
                </div>';
    
                // return $editBtn.$deleteBtn.$moreBtn;
                return $editBtn.$deleteBtn.$moreBtn;
            })
            // ->rawColumns(['image', 'type', 'status', 'action'])
            ->rawColumns(['image', 'status', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Course $model): QueryBuilder
    {
        $teacherId = Auth::user()->teacher->id;

        return $model->newQuery()->where('teacher_id', $teacherId);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('course-table')
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
                        Button::make('reload'),
                        // // เพิ่มปุ่มค้นหา
                        // Button::make('search'),
                        // // เพิ่มปุ่มนำทาง
                        // Button::make('pageLength')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            
            Column::make('id')->width(30), // กำหนดชื่อ column ที่ใช้ในการแสดงผลเป็น 'รหัส' แต่ใช้ชื่อ 'id' ในฐานข้อมูล
            Column::make('image')->title('รูปภาพ')->width(100), // กำหนดชื่อ column ที่ใช้ในการแสดงผลเป็น 'รูปภาพ' แต่ใช้ชื่อ 'image' ในฐานข้อมูล
            Column::make('name')->title('ชื่อ')->width(100), // กำหนดชื่อ column ที่ใช้ในการแสดงผลเป็น 'ชื่อ' แต่ใช้ชื่อ 'name' ในฐานข้อมูล
            Column::make('price')->title('ราคา')->width(50), // กำหนดชื่อ column ที่ใช้ในการแสดงผลเป็น 'ราคา' แต่ใช้ชื่อ 'price' ในฐานข้อมูล
            // Column::make('type')->title('ประเภท')->width(100), // กำหนดชื่อ column ที่ใช้ในการแสดงผลเป็น 'ประเภท' แต่ใช้ชื่อ 'type' ในฐานข้อมูล
            Column::make('status')->title('สถานะ')->width(50), // กำหนดชื่อ column ที่ใช้ในการแสดงผลเป็น 'สถานะ' แต่ใช้ชื่อ 'status' ในฐานข้อมูล
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Course_' . date('YmdHis');
    }
}
