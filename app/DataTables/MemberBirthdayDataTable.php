<?php

namespace App\DataTables;

use App\Models\Member;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MemberBirthdayDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Member> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
          
            ->addColumn("member_name", function($row) {
                return '<div class="flex items-center text-sm">
                            <!-- Avatar with inset shadow -->
                            <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                            <img class="object-cover w-full h-full rounded-full" src="https://gwadargymkhana.com.pk/members/storage/' . $row->profile_picture . '" alt="" loading="lazy">
                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true">
                            </div>
                            </div>
                            <div>
                            <p class="font-semibold">' . $row->member_name . '</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400" style="text-transform: capitalize;">' . $row->membership->card_name . ' Membership</p>
                            </div>
                            </div>';
            })
            ->addColumn("birthdate", function($row) {
                return \Carbon\Carbon::parse($row->date_of_birth)->format("d-F-Y");
            })
            ->rawColumns(["member_name"])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Member>
     */
    public function query(Member $model): QueryBuilder
    {
        $today = now();
        $end = now()->addDays(15);
        $members = Member::filter()
            ->orderByRaw("MONTH(date_of_birth), DAY(date_of_birth)")
            ->whereNotIn("payment_status", ["level3", "level4"])
            ->whereRaw("DATE_FORMAT(date_of_birth, '%m-%d') BETWEEN ? AND ?", [
                $today->format('m-d'),
                $end->format('m-d'),
            ]);
        return $members;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('membersTable')
                    ->addTableClass("w-full whitespace-no-wrap")
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->parameters([
                        'button' => ['excel']
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make("member_name")
                    ->addClass("px-4 py-3 text-sm"),
            Column::make("membership_number")
                    ->addClass("px-4 py-3 text-sm"),
            Column::computed("birthdate")
                    ->addClass("px-4 py-3 text-sm"),
            Column::make("residential_address")
                    ->addClass("px-4 py-3 text-sm")
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'MemberBirthday_' . date('YmdHis');
    }
}
