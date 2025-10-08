<?php

namespace App\DataTables;

use App\Models\Transaction;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TransactionDataTable extends DataTable
{
    /**
     * Build DataTable class.
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('created_at', function ($row) {
                return $row->created_at ? $row->created_at->format('d M Y') : '';
            });
    }

    /**
     * Get query source of dataTable.
     */
    public function query(Transaction $model)
    {
        return $model->newQuery()->select('transaction.*');
    }

    /**
     * Optional method if you want to use html builder.
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('transaction-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0, 'desc')
            ->parameters([
                'responsive' => true,
                'lengthMenu' => [[10, 25, 50, -1], [10, 25, 50, 'All']],
            ]);
    }

    /**
     * Get columns.
     */
    protected function getColumns()
    {
        return [
            Column::computed('DT_RowIndex')
                ->title('#')
                ->searchable(false)
                ->orderable(false)
                ->width(50),
            
            Column::make('trid')->title('Transaction ID'),
            Column::make('userid')->title('User ID'),
            Column::make('prcode')->title('Product Code'),
            Column::make('number')->title('Number'),
            Column::make('month')->title('Month'),
            Column::make('year')->title('Year'),
            Column::make('lotnumber')->title('Lot Number'),
            Column::make('status')->title('Status'),
            Column::make('created_at')->title('Date'),
        ];
    }

    /**
     * Get filename for export.
     */
    protected function filename(): string
    {
        return 'Transaction_' . date('YmdHis');
    }
}