<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Company;
use App\Models\Product;
use App\Models\InvoiceItems;
use Auth;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny',Invoice::class);
        $user = Auth::user();
        $user_id = $user->id;
        $role = Auth::user()->role;
        //IF SUPER ADMIN GET ALL COMPANIES
        if($user_id == 1){
            $invoices = Invoice::all();
        }else{
            //IF WEBMASTER GET PRODUCTS OWNED BY COMPMNY THAT WEBMASTER BELONGS TO
            if($role->id == $user->isWebMaster()){
                $companies = Company::where('user_id', $user_id)->get('id');
                $customers = Customer::whereIn('company_id',$companies)->get('id');
                $invoices = Invoice::whereIn('customer_id',$customers)->get();
            }
            //IF OFFICER GET PRODUCTS OWNED BY COMPMNY THAT OFFICER ASSIGNED TO
            elseif($role->id == $user->isOfficer()){
                $companies = $user->companies->pluck('id');
                $customers = Customer::whereIn('company_id',$companies)->get('id');
                $invoices = Invoice::whereIn('customer_id',$customers)->get();
            }
        }
        return view('invoices.index',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Customer $customer)
    {
        $this->authorize('create',Invoice::class);
        $products = Product::where('company_id',$customer->company_id)->get();
        return view('invoices.create',compact('customer','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create',Invoice::class);
        $rules = [
            'customer_id' => 'required|not in:Open this select menu',
            'billing_address' => 'required|max:255',
            'due_date' => 'required|date',
            'notes' => 'required',
            'discount' => 'nullable',
        ];
        $date = now();
        $this->validate($request, $rules);
        $data = $request->all();
        $customer = Customer::find($data['customer_id']);
        $company_name = Company::where('id',$customer->company_id)->first()->company_name;
        $company_name = strtoupper(substr($company_name,0,3)).'-'.$customer->id.'-'.$date->getTimestamp();
        $data['invoice_number']=$company_name;
        $data['invoice_date'] = $date;
        $subtotal = 0;
        for ($i = 0; $i < count($data['product_title']); $i++) {
            $subtotal = $subtotal + ($data['quantity'][$i] * $data['sales_price'][$i]);
        }
        $total = $subtotal;
        if(!empty($data['discount'])){
            if($data['discount_type']=='amount'){
                $total = $subtotal - $data['discount'];
            }elseif($data['discount_type']=='percent' && $data['discount']<100){
                $total = $subtotal - ($subtotal * $data['discount']/100);
            }else{
                $total = 0;
            }
        }
        $data['subtotal'] = $subtotal;
        $data['total'] = $total;
        $invoice = Invoice::create($data);
        for ($i = 0; $i < count($data['product_title']); $i++) {
            if(!empty($data['quantity'][$i])){
                InvoiceItems::create([
                    'invoice_id' => $invoice->id,
                    'product_title' => $data['product_title'][$i],
                    'quantity' => $data['quantity'][$i],
                    'unit_price' => $data['sales_price'][$i],
                    'total' => $data['quantity'][$i] * $data['sales_price'][$i],
                ]);
            }
        }
        
        return redirect()->route('invoices.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        $this->authorize('update',$invoice);
        $customer = Customer::findOrFail($invoice->customer_id);
        $products = Product::where('company_id',$customer->company_id)->get();
        $invoice_items = InvoiceItems::where('invoice_id',$invoice->id)->get();
        return view('invoices.edit',compact('invoice','products','customer','invoice_items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        $this->authorize('update',$invoice);
        $rules = [
            'customer_id' => 'required|not in:Open this select menu',
            'billing_address' => 'required|max:255',
            'due_date' => 'required|date',
            'discount' => 'nullable',
        ];
        $this->validate($request, $rules);
        $data = $request->all();
        $customer = Customer::find($data['customer_id']);
        $subtotal = 0;
        for ($i = 0; $i < count($data['product_title']); $i++) {
            $subtotal = $subtotal + ($data['quantity'][$i] * $data['sales_price'][$i]);
        }
        $total = $subtotal;
        if(!empty($data['discount'])){
            if($data['discount_type']=='amount'){
                $total = $subtotal - $data['discount'];
            }elseif($data['discount_type']=='percent' && $data['discount']<100){
                $total = $subtotal - ($subtotal * $data['discount']/100);
            }else{
                $total = 0;
            }
        }
        $data['subtotal'] = $subtotal;
        $data['total'] = $total;
        $invoice->update($data);
        $invoice->save();
        $invoice->items()->delete();
        for ($i = 0; $i < count($data['product_title']); $i++) {
            if(!empty($data['quantity'][$i])){
                InvoiceItems::create([
                    'invoice_id' => $invoice->id,
                    'product_title' => $data['product_title'][$i],
                    'quantity' => $data['quantity'][$i],
                    'unit_price' => $data['sales_price'][$i],
                    'total' => $data['quantity'][$i] * $data['sales_price'][$i],
                ]);
            }
        }
        
        return redirect()->route('invoices.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        $this->authorize('delete',$invoice);
        $invoice->delete();
        return redirect()->route('invoices.index');
    }

    public function delete(Invoice $invoice)
    {
        $this->authorize('delete',$invoice);
        return view('invoices.delete', ['invoice'=>$invoice]);
    }
}
