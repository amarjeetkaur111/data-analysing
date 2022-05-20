<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Arr;

class SalesComparisonTable extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run(BaseController $baseclass)
    {
        $fulldata = $baseclass->details();
        $sales = array();
        $sales[0]['year'] = date("Y");
        $sales[0]['TotalDollars'] = 0;
        $sales[0]['Difference'] = 0;
        $sales[0]['percentage'] = 100;  

        for($i = 1; $i < 6; $i++){
            $sales[$i]['year'] = $sales[0]['year'] - $i;
            $sales[$i]['TotalDollars'] = 0;
        }

        foreach($sales as $key => $value){
            $salesarray = array_filter($fulldata, function ($var) use($value){
                return ($var['StartDate'] >= $value['year'].'-01-01' && $var['EndDate'] <=$value['year'].'-12-31');
                });
            
            $dollararray = Arr::pluck($salesarray,'TotalDollars');
            $sales[$key]['TotalDollars'] += array_sum($dollararray);  
            $sales[$key]['Difference'] =  $sales[$key]['TotalDollars'] - $sales[0]['TotalDollars'];  
            if($sales[0]['TotalDollars'] > 0)
            $sales[$key]['percentage'] =  ($sales[$key]['Difference']/$sales[0]['TotalDollars'])*100; 
            else 
            $sales[$key]['percentage'] =  0;
        }
        return view('widgets.sales_comparison_table', [
            'config' => $this->config,
            'sales' => $sales,
        ]);
    }
}
