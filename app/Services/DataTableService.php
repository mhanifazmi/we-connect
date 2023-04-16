<?php

namespace App\Services;

use App\Models\SmsLog;

class DataTableService
{
    public static function getDataTableRequest($request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        return [
            'draw' => $draw,
            'start' => $start,
            'rowperpage' => $rowperpage,
            'columnIndex_arr' => $columnIndex_arr,
            'columnName_arr' => $columnName_arr,
            'order_arr' => $order_arr,
            'search_arr' => $search_arr,
            'columnIndex' => $columnIndex,
            'columnName' => $columnName,
            'columnSortOrder' => $columnSortOrder,
            'searchValue' => $searchValue,
        ];
    }
}
