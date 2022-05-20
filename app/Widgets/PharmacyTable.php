<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Models\PharmacyModel;


class PharmacyTable extends AbstractWidget
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
    public function run()
    {
        $GetPharmacy = PharmacyModel::get()->toArray();        
        return view('widgets.pharmacy_table', [
            'config' => $this->config,
            'data'=>$GetPharmacy,
        ]);
    }
}
