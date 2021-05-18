<?php

namespace App\Repositories;

use Illuminate\Http\Request;

class Repository {

    public function clean_date(Request $request, $inputs)
    {
        foreach ($inputs as $input) {
            if ($request->has($input))
                $request->merge([$input => unformat_date($request->input($input))]);
        }
        return $request;
    }

    public function clean_number(Request $request, $inputs)
    {
        foreach ($inputs as $input) {
            if ($request->has($input))
                $request->merge([$input => unformat_number($request->input($input))]);
        }
        return $request;
    }

}
