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
        $invoice = $this->invoice->with(['project.client', 'profile']);

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
        foreach ($request->input('item') as $key => $item) {
            if ($item != '') {
                $this->save_detail(new Request([
                    'invoice_id' => $invoice->id,
                    'item' => $item,
                    'qty' => $request->input('qty')[$key],
                    'unit' => $request->input('unit')[$key],
                    'price' => $request->input('price')[$key],
                    'id' => $request->input('detail_id')[$key],
                ]));
            }
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

    public function auto_number()
    {
        $last = $this->invoice
            ->where('date', 'like', date('Y-m').'-%')
            ->orderBy('no_invoice', 'desc')
            ->first();
        $last_no = empty($last) ? 1 : intval(last(explode('/', $last->no_invoice)))+1;
        for ($i = 1; strlen($last_no) <= 4; $i++) $last_no = '0' . $last_no;
        return "INV/" . date('Ym') . '/' . $last_no;
    }

}
