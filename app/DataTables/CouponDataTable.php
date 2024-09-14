<?php

namespace App\DataTables;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CouponDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('discount', function ($query) {
                return $query->discount ? '<h6>' . $query->discount . ' &#3647' . '</h6>' : '-';
            })
            ->addColumn('discount_percentage', function ($query) {
                return $query->discount_percentage ? '<h6>' . $query->discount_percentage . ' %' . '</h6>' : '-';
            })
            ->addColumn('action', function($query){
                $editBtn = "<a href='".route('admin.coupons.edit', $query->id)."' class='btn btn-primary' style='background-color: #ffc107;'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='".route('admin.coupons.destroy', $query->id)."' class='btn btn-danger ml-2 delete-item' style='background-color: #e74c3c;'><i class='far fa-trash-alt'></i></a>";

                return $editBtn.$deleteBtn;
            })
            ->rawColumns(['discount','discount_percentage', 'action'])
            ->setRowId('id');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Coupon $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('coupon-table')
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

            Column::make('id')->title('รหัส'),
            Column::make('code')->title('คูปองโค้ด'),
            Column::make('discount')->title('จำนวนส่วนลด'),
            Column::make('discount_percentage')->title('ส่วนลดเปอร์เซ็นต์ %'),
            Column::make('expires_at')->title('หมดอายุ ณ'),
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
        return 'Coupon_' . date('YmdHis');
    }
}
