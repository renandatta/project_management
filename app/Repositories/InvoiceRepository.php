<?php

namespace App\Repositories;

use App\Models\Invoice;
use App\Models\InvoiceDetail;
use Illuminate\Http\Request;

class InvoiceRepository extends Repository {

    protected $invoice, $detail;
    public function __construct(Invoice $invoice, InvoiceDetail $detail)
    {
        $this->invoice = $invoice;
        $this->detail = $detail;
    }

    public function search(Request $request)
    {
        $invoice = $this->invoice->with(['project']);

        $project_id = $request->input('project_id') ?? '';
        if ($project_id != '')
            $invoice = $invoice->where('project_id', $project_id);

        $client_id = $request->input('client_id') ?? '';
        if ($client_id != '')
            $invoice = $invoice->whereHas('project', function ($project) use ($client_id) {
                $project->where('client_id', $client_id);
            });

        $paginate = $request->input('paginate') ?? null;
        if ($paginate != null) return $invoice->paginate(10);
        return $invoice->get();
    }

    public function find($value, $column = 'id')
    {
        return $this->invoice->where($column, $value)->first();
    }

    public function save(Request $request)
    {
        $request = $this->clean_date($request, ['date', 'date_due']);
        $id = $request->input('id') ?? '';
        if ($id == '')
            $invoice = $this->invoice->create($request->all());
        else {
            $invoice = $this->invoice->find($id);
            if (empty($invoice)) return $invoice;
            $invoice->update($request->all());
        }
        return $invoice;
    }

    public function delete($id)
    {
        $invoice = $this->invoice->find($id);
        if (empty($invoice)) return $invoice;
        $invoice->delete();
        return $invoice;
    }

    public function find_detail($value, $column = 'id')
    {
        return $this->detail->where($column, $value)->first();
    }

    public function save_detail(Request $request)
    {
        $request = $this->clean_number($request, ['price', 'qty']);
        $id = $request->input('id') ?? '';
        if ($id == '')
            $detail = $this->detail->create($request->all());
        else {
            $detail = $this->detail->find($id);
            if (empty($detail)) return $detail;
            $detail->update($request->all());
        }
        return $detail;
    }

    public function delete_detail($id)
    {
        $detail = $this->detail->find($id);
        if (empty($detail)) return $detail;
        $detail->delete();
        return $detail;
    }

}
