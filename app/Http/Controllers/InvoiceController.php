<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceSaveRequest;
use App\Repositories\InvoiceRepository;
use App\Repositories\ProfileRepository;
use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    protected $invoice;
    public function __construct(InvoiceRepository $invoice,
                                ProjectRepository $project, ProfileRepository $profile)
    {
        $this->invoice = $invoice;
        view()->share(['list_projects' => $project->dropdown()]);
        view()->share(['list_profiles' => $profile->dropdown()]);
    }

    public function index()
    {
        session(['menu_active' => 'invoices']);
        return view('invoices.index');
    }

    public function search(Request $request)
    {
        $invoices = $this->invoice->search($request);
        return view('invoices._table', compact('invoices'));
    }

    public function info($id = null)
    {
        session(['menu_active' => 'invoices']);
        $invoice = $this->invoice->find($id);
        if (!empty($invoice)) $invoice->details();
        $no_invoice = !empty($invoice) ? $invoice->no_invoice : $this->invoice->auto_number();
        return view('invoices.info', compact('invoice', 'no_invoice'));
    }

    public function save(InvoiceSaveRequest $request)
    {
        $this->invoice->save($request);
        return redirect()->route('invoices');
    }

    public function details_info(Request $request)
    {
        $index = $request->input('index') ?? '1';
        $detail = $this->invoice->find_detail($request->input('id'));
        return view('invoices._item_detail', compact('detail', 'index'));
    }

    public function details_delete(Request $request)
    {
        return $this->invoice->delete_detail($request->input('id'));
    }
}
