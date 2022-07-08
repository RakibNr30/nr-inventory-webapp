<?php

namespace Modules\Cms\DataTables;

use Modules\Cms\Entities\Logistic;
use Modules\Ums\Entities\UserPrefix;
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
            ->addColumn('influencer_id', function ($data) {
                return view('cms::logistic.influencer_id', compact('data'))->render();
            })->addColumn('status', function ($data) {
                return view('cms::logistic.status', compact('data'))->render();
            })->rawColumns(['influencer_id', 'status']);
    }

    public function getDataForExport(): array
    {
        $userPrefix = UserPrefix::query()->firstOrCreate([
            'id' => 1
        ]);

        $prefix = $userPrefix->prefix ?? '';

        $logistic = (new Logistic())->newQuery();

        $logistic->leftJoin('users as influencer', 'influencer.id', 'logistics.influencer_id')
            ->leftJoin('user_shipping_infos as influencer_shipping_info', 'influencer_shipping_info.user_id', 'logistics.influencer_id')
            ->leftJoin('products', 'products.id', 'logistics.product_id')
            ->leftJoin('users as brand', 'brand.id', 'products.brand_id');

        $logistic->select([
            'influencer.id as influencer_id',
            'influencer_shipping_info.first_name as first_name',
            'influencer_shipping_info.last_name as last_name',
            'influencer_shipping_info.address as shipping_address',
            'influencer_shipping_info.zip_code as zip',
            'influencer_shipping_info.city as city',
            'influencer_shipping_info.country_code as country_code',
            'influencer.email as email',
            'logistics.product_count as product_count',
            'products.id as product_id',
            'products.title as product_name',
            'brand.brand_priority as product_order',
        ]);

        $logistic->where('is_shipped_out', 0);

        $logistic->orderBy('influencer_id')->orderBy('product_order');

        $logistics = $logistic->get()->map(function ($item) use ($prefix) {
            return [
                $item->influencer_id => $prefix . $item->influencer_id,
                $item->first_name,
                $item->last_name,
                $item->shipping_address,
                $item->zip,
                $item->city,
                $item->country_code,
                $item->email,
                $item->product_count,
                $item->product_id,
                $item->product_name,
                $item->product_order
            ];
        });

        return $logistics->toArray();
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

        $logistic->leftJoin('users as influencer', 'influencer.id', 'logistics.influencer_id')
            ->leftJoin('user_shipping_infos as influencer_shipping_info', 'influencer_shipping_info.user_id', 'logistics.influencer_id')
            ->leftJoin('products', 'products.id', 'logistics.product_id')
            ->leftJoin('users as brand', 'brand.id', 'products.brand_id');

        $logistic->select([
            'logistics.id as id',
            'logistics.product_count as product_count',
            'logistics.is_shipped_out as is_shipped_out',
            'influencer.id as influencer_id',
            'influencer.email as email',
            'products.id as product_id',
            'products.title as product_name',
            'brand.brand_priority as product_order',
            'influencer_shipping_info.first_name as first_name',
            'influencer_shipping_info.last_name as last_name',
            'influencer_shipping_info.address as shipping_address',
            'influencer_shipping_info.zip_code as zip',
            'influencer_shipping_info.city as city',
            'influencer_shipping_info.country_code as country_code',
        ]);

        $logistic->orderBy('influencer_id')->orderBy('product_order');

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
            Column::computed('influencer_id')->title('Influencer ID')
                ->exportable()
                ->printable()
                ->searchable(),
            Column::make('first_name')->name('influencer_shipping_info.first_name')->orderable(false),
            Column::make('last_name')->name('influencer_shipping_info.last_name')->orderable(false),
            Column::make('shipping_address')->name('influencer_shipping_info.address')->orderable(false),
            Column::make('zip')->name('influencer_shipping_info.zip_code')->orderable(false),
            Column::make('city')->name('influencer_shipping_info.city')->orderable(false),
            Column::make('country_code')->name('influencer_shipping_info.country_code')->orderable(false),
            Column::make('email')->name('influencer.email')->orderable(false),
            Column::make('product_count')->name('logistics.product_count')->orderable(false),
            Column::make('product_id')->name('products.id')->orderable(false),
            Column::make('product_name')->name('products.title')->orderable(false),
            Column::make('product_order')->name('brand.brand_priority')->orderable(false),
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
