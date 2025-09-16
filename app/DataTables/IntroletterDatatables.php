<?php

namespace App\DataTables;

use App\Models\Introletter;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class IntroletterDatatables extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Introletter> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn("member_name", function($row) {
                return $row->member->member_name;
            })
            ->addColumn("membership_number", function($row) {
                return $row->member->membership_number;
            })
            ->addColumn("club_name", function($row) {
                return $row->club->club_name;
            })
            ->addColumn("duration", function($row) {
                return $row->duration->months . " Months";
            })
            ->addColumn("issue_date", function($row) {
                return \Carbon\Carbon::parse($row->issue_date)->format("d");
            })
            ->addColumn('action', 'introletterdatatables.action')
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Introletter>
     */
    public function query(Introletter $model): QueryBuilder
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
            Column::make("spouse")
                    ->addClass("px-4 py-3 text-sm"),
            Column::make("children")
                    ->addClass("px-4 py-3 text-sm"),
            Column::make("club_name")
                    ->addClass("px-4 py-3 text-sm"),
            Column::make("duration")
                    ->addClass("px-4 py-3 text-sm"),
            Column::make("action")
                    ->addClass("px-4 py-3 text-sm"),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'IntroletterDatatables_' . date('YmdHis');
    }
}
