<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sort()
    {
        $arr = [7, 2, -5, 3, 1, 9, 8];
        // return $this->split($arr);
        return $this->bubble($arr);
    }

    private function split($arr)
    {
        $count = count($arr);

        if($count <= 1) {
            return $arr;
        }

        $left = array_slice($arr, 0, (int) $count / 2 );
        $right = array_slice($arr, (int) $count / 2);

        $left = $this->split($left);
        $right = $this->split($right);

        return $this->compare($left, $right);
    }

    private function compare($left, $right)
    {
        $result = [];

        while(count($left) > 0 && count($right) > 0) {
            if($left[0] < $right[0]) {
                $result[] = array_shift($left);
                // array_push($result, array_shift($left));
            } else {
                $result[] = array_shift($right);
                // array_push($result, array_shift($right));
            }
        }

        // array_splice($result, count($result), 0, $left);
        // array_splice($result, count($result), 0, $right);

        $result = array_merge($result, $left, $right);

        return $result;
    }

    private function bubble($arr)
    {
        $count = count($arr);

        for($i = 0; $i < $count; $i++) {
            for($j = $i+1; $j < $count; $j++) {
                if($arr[$j] < $arr[$i]) {
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$i];
                    $arr[$i] = $temp;
                }
            }
        }

        return $arr;
    }
}
