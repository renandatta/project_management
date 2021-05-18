<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReceiptSaveRequest;
use App\Http\Requests\DeleteRequest;
use App\Repositories\InvoiceRepository;
use App\Repositories\ReceiptRepository;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    protected $receipt, $invoice;
    public function __construct(ReceiptRepository $receipt, InvoiceRepository $invoice)
    {
        $this->receipt = $receipt;
        $this->invoice = $invoice;
    }

    public function index()
    {
        session(['menu_active' => 'receipts']);
        return view('receipts.index');
    }

    public function search(Request $request)
    {
        $receipts = $this->receipt->search($request);
        return view('receipts._table', compact('receipts'));
    }

    public function info(Request $request, $id = '')
    {
        $receipt = $this->receipt->find($id);
        if (!empty($receipt)) $request->merge(['invoice_id' => $receipt->invoice_id]);
        $invoice = $this->invoice->find($request->input('invoice_id'));
        if (empty($invoice)) return redirect()->route('invoices');
        return view('receipts.info', compact('receipt', 'invoice'));
    }

    public function save(ReceiptSaveRequest $request)
    {
        return $this->receipt->save($request);
    }

    public function delete(DeleteRequest $request)
    {
        return $this->receipt->delete($request->input('id'));
    }

    public function print($id)
    {
        $receipt = $this->receipt->find($id);
        $invoice = $this->invoice->find($receipt->invoice_id);
        return view('receipts.print', compact('receipt', 'invoice'));
    }

}
