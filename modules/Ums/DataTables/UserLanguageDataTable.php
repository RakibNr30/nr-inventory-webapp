<?php

namespace Modules\Ums\DataTables;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

// models...
use Modules\Ums\Entities\UserLanguage;

class UserLanguageDataTable extends DataTable
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
                return view('ums::user_language.action', compact('data'))->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param UserLanguage $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(UserLanguage $model)
    {
        // user_language model instance
        $user_language = $model->newQuery();

        // apply joins
        $user_language->join('user_additional_infos', 'user_languages.user_id', 'user_additional_infos.id')
            ->join('users', 'user_languages.user_id', 'users.id');

        // select queries
        $user_language->select([
            'user_languages.id',
            'users.username as username',
            DB::raw('CONCAT(user_additional_infos.first_name," ",user_additional_infos.last_name) as name'),
            'user_languages.name as language',
            'user_languages.proficiency',
            'user_languages.updated_at'
        ]);

        // return data
        return $user_language;
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
            Column::make('username')->name('users.username')->hidden(), // alias used
            Column::make('name')->name('user_additional_infos.first_name'), // alias used
            Column::make('name')->name('user_additional_infos.last_name')->hidden(), // alias used
            Column::make('language')->name('user_languages.name'), // alias used
            Column::make('proficiency'),
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
        return 'UserLanguage_' . date('YmdHis');
    }
}
