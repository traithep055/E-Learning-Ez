<?php

namespace App\DataTables;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LessonDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'lesson.action')
            ->addColumn('action', 'lesson.action')
            ->addColumn('file_doc', function ($query) {
                if ($query->file_doc === null) {
                    return '<i class="badge bg-warning">Null</i>';
                } else {
                    return '<i class="badge bg-success">Have Document</i> 
                        <button class="btn btn-danger delete-filedoc" data-id="'.$query->id.'"><i class="far fa-trash-alt"></i></button>';
                }
            })

            ->addColumn('video_url', function ($query) {
                if ($query->video_url === null) {
                    return '<i class="badge bg-warning">Null</i>';
                } else {
                    return '<i class="badge bg-success">Have Video_Url</i> ';
                }
            })
            ->addColumn('video_path', function ($query) {
                if ($query->video_path === null) {
                    return '<i class="badge bg-warning">Null</i>';
                } else {
                    return '<i class="badge bg-success">Have Video</i> 
                    <button class="btn btn-danger delete-filevideo" data-id="'.$query->id.'"><i class="far fa-trash-alt"></i></button>';
                }
            })
            ->addColumn('action', function($query){
                $editBtn = "<a href='".route('teacher.lesson.edit', ['lesson' => $query->id, 'course' => request()->query('course')])."' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='".route('teacher.lesson.destroy', $query->id)."' class='btn btn-danger delete-item' ><i class='far fa-trash-alt'></i></a>";
    
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
            ->rawColumns(['file_doc', 'video_url', 'video_path', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Lesson $model): QueryBuilder
    {
        // กรองเฉพาะ lesson ที่เป็นของ course ที่ส่งมาจาก CourseDataTable
        return $model->newQuery()->where('course_id', request()->query('course'));
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('lesson-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->language([
                        "lengthMenu" => "แสดง _MENU_ รายการต่อหน้า",
                        "zeroRecords" => "ไม่พบข้อมูล",
                        "info" => "แสดง _START_ ถึง _END_ จาก _TOTAL_ รายการ",
                        "infoEmpty" => "ไม่มีข้อมูล",
                        "infoFiltered" => "(กรองข้อมูลจากทั้งหมด _MAX_ รายการ)",
                        "search" => "ค้นหา:",
                        "paginate" => [
                            "first" => "หน้าแรก",
                            "last" => "หน้าสุดท้าย",
                            "next" => "ถัดไป",
                            "previous" => "ก่อนหน้า"
                        ]
                    ])
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
            
            Column::make('id'),
            Column::make('lesson_name')->title('ชื่อบทเรียน'),
            Column::make('file_doc')->title('ไฟล์เอกสาร'),
            Column::make('video_url')->title('ลิงค์วิดีโอ'),
            Column::make('video_path')->title('ไฟล์วิดีโอ'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->title('การทำงาน')
                  ->width(200)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Lesson_' . date('YmdHis');
    }
}
