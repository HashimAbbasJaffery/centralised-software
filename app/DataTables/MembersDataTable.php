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

class MembersDataTable extends DataTable
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
            ->addColumn("locker_number", function($row) {
                return $row->locker_category . "" . $row->locker_number;
            })
            ->addColumn("has_receipt_created", function($row) {
                return $row->has_receipt_created == 1 
                            ? 
                                '<div class="progress-container" style="text-align: center;">
                                    <p>Created</p>
                                </div>'
                            : 
                                '<div class="progress-container"><div class="progress-bar"></div></div>';
            })
            ->addColumn("actions", function($row) {
                return '
                    <div class="flex items-center space-x-4 text-sm">
                    <a href="' . route('member.updated', [ 'member' => $row->id ]) . '" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                    </svg>
                    </a>
                    <button @click="alert("test")" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete"><svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd">
                    </path>
                    </svg>
                    </button>
                    <a href="' . route('member.get', [ 'member' => $row->id ]) . '" class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"><i class="fa-solid fa-eye" aria-hidden="true" style="color: rgba(126, 58, 242, var(--text-opacity));"></i>
                    </a>
                    <a href="' . route('download.family-sheet', [ 'member' => $row->id ]) . '" class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple">
                    <i class="fa-solid fa-sheet-plastic" aria-hidden="true" style="color: rgba(126, 58, 242, var(--text-opacity));"></i>
                    </a>
                    </div>
                ';
            })
            ->setRowClass("text-gray-700 dark:text-gray-400")
            ->rawColumns(["actions", "member_name", "has_receipt_created"])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Member>
     */
    public function query(Member $model): QueryBuilder
    {
        return $model->query()->latest();
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
            Column::make("file_number")
                    ->addClass("px-4 py-3 text-sm"),
            Column::computed("locker_number")
                    ->addClass("px-4 py-3 text-sm"),
            Column::computed("has_receipt_created", "Progress")
                    ->addClass("px-4 py-3 text-sm"),
            Column::computed("actions", "action")
                    ->addClass("px-4 py-3 text-sm"),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Members_' . date('YmdHis');
    }
}
