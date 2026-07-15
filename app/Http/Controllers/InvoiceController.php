<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\CompanySetting;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    // LIST INVOICES
    public function index()
    {
        $invoices = Invoice::where('user_id', Auth::id())
                    ->latest()
                    ->get();

        return view('invoices.index', compact('invoices'));
    }

    // CREATE FORM
    public function create()
    {
        $customers = Customer::where('user_id', Auth::id())->get();

        $products = Product::where('user_id', Auth::id())->get();

        return view('invoices.create', compact('customers', 'products'));
    }

    // STORE INVOICE
    public function store(Request $request)
    {
        // VALIDATION
        $request->validate([

            'customer_id' => 'required|exists:customers,id',

            'products' => 'required|array|min:1',

            'products.*' => 'required|exists:products,id',

            'quantities' => 'required|array|min:1',

            'quantities.*' => 'required|integer|min:1',

        ]);

        // CHECK CUSTOMER BELONGS TO USER
        $customer = Customer::where('user_id', Auth::id())
                        ->findOrFail($request->customer_id);
        $company = CompanySetting::where(
            'user_id',
            Auth::id()
        )->first();
        // AUTO INVOICE NUMBER
        $lastInvoice = Invoice::latest()->first();

        $number = $lastInvoice ? $lastInvoice->id + 1 : 1;

        $invoiceNo = 'INV-' . date('Y') . '-' .
            str_pad($number, 4, '0', STR_PAD_LEFT);

        $subtotal = 0;
        $gstTotal = 0;
        $grandTotal = 0;

        // CALCULATE TOTALS
        foreach ($request->products as $key => $productId) {

            // SECURITY CHECK
            $product = Product::where('user_id', Auth::id())
                        ->findOrFail($productId);

            $qty = $request->quantities[$key];

            $price = $product->price;

            $gstPercent = $product->gst_percent;

            $gstAmount = (($price * $gstPercent) / 100) * $qty;

            $total = ($price * $qty) + $gstAmount;

            $subtotal += ($price * $qty);

            $gstTotal += $gstAmount;

            $grandTotal += $total;
        }

        // CREATE INVOICE
        $invoice = Invoice::create([

            'user_id' => Auth::id(),

            'customer_id' => $customer->id,

            'invoice_no' => $invoiceNo,

            'subtotal' => $subtotal,

            'gst_total' => $gstTotal,

            'grand_total' => $grandTotal,

            'invoice_date' => now(),

        ]);

        // STORE ITEMS
        foreach ($request->products as $key => $productId) {

            $product = Product::where('user_id', Auth::id())
                        ->findOrFail($productId);

            $qty = $request->quantities[$key];

            $price = $product->price;

            $gstPercent = $product->gst_percent;

            $gstAmount = (($price * $gstPercent) / 100) * $qty;

            // COMPANY STATE
            $companyState = $company->state;

            // CUSTOMER STATE
            $customerState = $customer->state;

            // DEFAULT VALUES
            $cgstPercent = 0;
            $sgstPercent = 0;
            $igstPercent = 0;

            $cgstAmount = 0;
            $sgstAmount = 0;
            $igstAmount = 0;

            // SAME STATE
            if($companyState == $customerState){

                $cgstPercent = $gstPercent / 2;

                $sgstPercent = $gstPercent / 2;

                $cgstAmount = $gstAmount / 2;

                $sgstAmount = $gstAmount / 2;

            }

            // DIFFERENT STATE
            else{

                $igstPercent = $gstPercent;

                $igstAmount = $gstAmount;

            }

            $total = ($price * $qty) + $gstAmount;

            InvoiceItem::create([

                'invoice_id' => $invoice->id,

                'product_id' => $productId,

                'quantity' => $qty,

                'price' => $price,

                'gst_percent' => $gstPercent,

                'gst_amount' => $gstAmount,

                'total' => $total,

                'cgst_percent' => $cgstPercent,

                'sgst_percent' => $sgstPercent,

                'igst_percent' => $igstPercent,

                'cgst_amount' => $cgstAmount,

                'sgst_amount' => $sgstAmount,

                'igst_amount' => $igstAmount,

            ]);
        }

        return redirect()
            ->route('invoices.index')
            ->with('success', 'Invoice Created Successfully');
    }
    public function show($id)
    {
        // phpinfo();
        // dd();
        $invoice = Invoice::where('user_id', Auth::id())
                    ->with(['customer', 'items.product'])
                    ->findOrFail($id);
        $company = CompanySetting::where(
            'user_id',
            Auth::id()
        )->first();

        return view('invoices.show', compact('invoice','company'));
    }
    public function downloadPdf($id)
    {
        $invoice = Invoice::where('user_id', Auth::id())
                    ->with(['customer', 'items.product'])
                    ->findOrFail($id);
                    $company = CompanySetting::where(
            'user_id',
            Auth::id()
        )->first();

        $pdf = Pdf::loadView('invoices.pdf', compact('invoice','company'));

        return $pdf->download($invoice->invoice_no . '.pdf');
    }
}