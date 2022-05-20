<?php

namespace Modules\Cms\DataTables;

use Modules\Cms\Entities\Logistic;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LogisticDataTable extends DataTable
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
            /*->addColumn('action', function ($data) {
                return view('cms::logistic.action', compact('data'))->render();
            })*/->addColumn('status', function ($data) {
                return view('cms::logistic.status', compact('data'))->render();
            })->rawColumns(['status']);
    }

    public function getDataForExport(): array
    {
        $logistic = (new Logistic())->newQuery();
        $logistic->orderBy('influencer_id')->orderBy('product_order');
        $logistic->where('is_shipped_out', false);
        $logistic->select([
            'influencer_id',
            'first_name',
            'last_name',
            'shipping_address',
            'zip',
            'city',
            'country_code',
            'email',
            'product_count',
            'product_id',
            'product_name',
            'product_order',
        ]);

        return $logistic->get()->toArray();
    }

    /**
     * Get query source of dataTable.
     *
     * @param Logistic $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Logistic $model)
    {
        $logistic = $model->newQuery();
        $logistic->orderBy('influencer_id')
            ->orderBy('product_order');

        return $logistic;
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
                //Button::make('create'),
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
            Column::make('influencer_id'),
            Column::make('first_name'),
            Column::make('last_name'),
            Column::make('shipping_address'),
            Column::make('zip'),
            Column::make('city'),
            Column::make('country_code'),
            Column::make('email'),
            Column::make('product_count'),
            Column::make('product_id'),
            Column::make('product_name'),
            Column::make('product_order'),
            //Column::computed('action'),
            Column::computed('status')->title('Is Shipped Out?')
                ->exportable(false)
                ->printable(false)
                ->searchable()
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
        return 'Logistic_' . date('YmdHis');
    }
}
