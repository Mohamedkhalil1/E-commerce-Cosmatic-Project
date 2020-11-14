<?php

namespace App\Observers;

use App\Models\Invoice;
use App\Models\InvoiceProduct;

class InvoiceOobserver
{
    /**
     * Handle the main_ category "deleted" event.
     *
     * @param  \App\Main_Category  $mainCategory
     * @return void
     */
    public function deleted(Invoice $invoice)
    {
      $invoices = InvoiceProduct::where('invoice_id',$invoice->id)->get();
      foreach($invoices as $invoice){
          $invoice->delete();
      }
    }

}
