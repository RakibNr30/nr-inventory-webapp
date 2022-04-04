<?php

namespace Modules\Ums\DataTables;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

// models...
use Modules\Ums\Entities\UserAdditionalInfo;

class UserAdditionalInfoDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return view('ums::user_additional_info.action', compact('data'))->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param UserAdditionalInfo $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(UserAdditionalInfo $model)
    {
        // user_additional_info model instance
        $user_additional_info = $model->newQuery();

        // apply joins
        $user_additional_info->join('users', 'user_additional_infos.user_id', 'users.id');

        $user_additional_info->select([
            'user_additional_infos.id',
            'users.username as username',
            DB::raw('CONCAT(user_additional_infos.first_name," ",user_additional_infos.last_name) as name'),
            DB::raw('CONCAT(user_additional_infos.first_name_bn," ",user_additional_infos.last_name_bn) as name_bn'),
            'user_additional_infos.mobile_no',
            'user_additional_infos.personal_email',
            'user_additional_infos.gender',
            'user_additional_infos.updated_at'
        ]);

        // return data
        return $user_additional_info;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('data_table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bflrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reload')
            )
            ->parameters([
                'pageLength' => 10
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('DT_RowIndex')
                ->title('Sl'),
            Column::make('username')->name('users.username'), // alias used
            Column::make('name')->name('user_additional_infos.first_name'), // alias used
            Column::make('name')->name('user_additional_infos.last_name')->hidden(), // alias used
            Column::make('name_bn')->name('user_additional_infos.first_name_bn'), // alias used
            Column::make('name_bn')->name('user_additional_infos.last_name_bn')->hidden(), // alias used
            Column::make('mobile_no'),
            Column::make('personal_email'),
            Column::make('gender'),
            Column::make('updated_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'UserAdditionalInfo_' . date('YmdHis');
    }
}
