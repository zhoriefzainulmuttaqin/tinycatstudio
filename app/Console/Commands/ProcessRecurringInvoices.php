<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ClientInvoice;
use Carbon\Carbon;

class ProcessRecurringInvoices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoices:process-recurring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process recurring invoices that are due to be created today';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();
        
        $dueInvoices = ClientInvoice::where('is_recurring', true)
            ->whereNotNull('next_recurring_date')
            ->whereDate('next_recurring_date', '<=', $today)
            ->get();

        $count = 0;
        
        foreach ($dueInvoices as $parentInvoice) {
            // Replicate the invoice
            $newInvoice = $parentInvoice->replicate([
                'invoice_number', 
                'issue_date', 
                'due_date', 
                'status',
                'is_recurring',
                'recurring_interval',
                'next_recurring_date',
                'parent_invoice_id',
            ]);
            
            $newInvoice->invoice_number = 'INV-' . strtoupper(str()->random(6));
            $newInvoice->issue_date = $today;
            
            // Calculate new due date based on the difference from the original invoice
            $daysToDue = $parentInvoice->issue_date->diffInDays($parentInvoice->due_date);
            $newInvoice->due_date = $today->copy()->addDays($daysToDue);
            
            $newInvoice->status = 'draft';
            $newInvoice->is_recurring = false;
            $newInvoice->parent_invoice_id = $parentInvoice->id;
            
            $newInvoice->save();
            
            // Copy items
            foreach ($parentInvoice->items as $item) {
                $newItem = $item->replicate(['client_invoice_id']);
                $newItem->client_invoice_id = $newInvoice->id;
                $newItem->save();
            }
            
            // Update the next recurring date on the parent invoice
            $nextDate = Carbon::parse($parentInvoice->next_recurring_date);
            if ($parentInvoice->recurring_interval === 'weekly') {
                $nextDate->addWeek();
            } elseif ($parentInvoice->recurring_interval === 'monthly') {
                $nextDate->addMonth();
            } elseif ($parentInvoice->recurring_interval === 'yearly') {
                $nextDate->addYear();
            }
            
            $parentInvoice->update(['next_recurring_date' => $nextDate]);
            $count++;
        }
        
        $this->info("Processed {$count} recurring invoices.");
    }
}
