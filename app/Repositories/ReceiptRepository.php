<?php

namespace App\Repositories;

use App\Models\Receipt;
use Illuminate\Http\Request;

class ReceiptRepository extends Repository {

    protected $receipt;
    public function __construct(Receipt $receipt)
    {
        $this->receipt = $receipt;
    }

    public function search(Request $request)
    {
        $receipt = $this->receipt
            ->orderBy('date', 'desc')
            ->with(['invoice']);

        $paginate = $request->input('paginate') ?? null;
        if ($paginate != null) return $receipt->paginate(10);
        return $receipt->get();
    }

    public function find($value, $column = 'id')
    {
        return $this->receipt->where($column, $value)->first();
    }

    public function save(Request $request)
    {
        $request = $this->clean_number($request, ['total']);
        $request = $this->clean_date($request, ['date']);
        $id = $request->input('id') ?? '';
        if ($id == '') {
            $request->merge(['no_receipt' => $this->auto_number()]);
            $receipt = $this->receipt->create($request->all());
        } else {
            $receipt = $this->receipt->find($id);
            if (empty($receipt)) return $receipt;
            $receipt->update($request->all());
        }
        return $receipt;
    }

    public function delete($id)
    {
        $receipt = $this->receipt->find($id);
//        if (!empty($receipt)) return $receipt;
        $receipt->delete();
        return $receipt;
    }

    public function auto_number()
    {
        $last = $this->receipt
            ->where('date', 'like', date('Y-m').'-%')
            ->orderBy('no_receipt', 'desc')
            ->first();
        $last_no = empty($last) ? 1 : intval(last(explode('/', $last->no_receipt)))+1;
        for ($i = 1; strlen($last_no) <= 4; $i++) $last_no = '0' . $last_no;
        return "RCP/" . date('Ym') . '/' . $last_no;
    }

}
