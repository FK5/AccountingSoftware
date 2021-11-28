<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Customer;
use App\Models\Company;
use App\Models\Invoice;
use App\Models\PaymentItems;
use Illuminate\Http\Request;
use Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Payment::class);
        $user = Auth::user();
        $user_id = $user->id;
        $role = Auth::user()->role;
        //IF SUPER ADMIN GET ALL COMPANIES
        if($user_id == 1){
            $payments = Payment::all();
        }else{
            //IF WEBMASTER GET PRODUCTS OWNED BY COMPMNY THAT WEBMASTER BELONGS TO
            if($role->id == $user->isWebMaster()){
                $companies = Company::where('user_id', $user_id)->get('id');
                $customers = Customer::whereIn('company_id',$companies)->get('id');
                $payments = Payment::whereIn('customer_id',$customers)->get();
            }
            //IF OFFICER GET PRODUCTS OWNED BY COMPMNY THAT OFFICER ASSIGNED TO
            elseif($role->id == $user->isOfficer()){
                $companies = $user->companies->pluck('id');
                $customers = Customer::whereIn('company_id',$companies)->get('id');
                $payments = Payment::whereIn('customer_id',$customers)->get();
            }
        }
        return view('payments.index',compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Customer $customer)
    {
        $this->authorize('create', Payment::class);
        return view('payments.create',compact('customer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Payment::class);
        $rules = [
            'payment_method' => 'required|max:255',
            'amount' => 'required|numeric',
        ];
        $date = now();
        $this->validate($request, $rules);
        $data = $request->all();
        $data['payment_date']=$date;

        $payment = Payment::create($data);
        
        return redirect()->route('payments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        $this->authorize('update', $payment);
        return view('payments.edit',compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $this->authorize('update', $payment);
        $rules = [
            'payment_method' => 'required|max:255',
            'amount' => 'required|numeric',
        ];
        $date = now();
        $this->validate($request, $rules);
        $data = $request->all();
        $data['payment_date']=$date;

        $payment->update($data);
        
        return redirect()->route('payments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $this->authorize('delete', $payment);
        $payment->delete();
        return redirect()->route('payments.index');
    }

    public function delete(Payment $payment)
    {
        $this->authorize('delete', $payment);
        return view('payments.delete', ['payment'=>$payment]);
    }

    public function assign(Customer $customer)
    {
        $this->authorize('create', Payment::class);
        $invoices = Invoice::where('customer_id', $customer->id)->get()->filter(function($invoice){
            return $invoice->amount_unpaid != 0;
        });
        $payments = Payment::where('customer_id', $customer->id)->get()->filter(function($payment){
            return $payment->remaining != 0;
        });
        return view('payments.assign', compact('customer','invoices','payments'));
    }

    public function link(Request $request)
    {
        $this->authorize('create', Payment::class);
        $rules = [
            'payment_id' => 'required|not in:Open this select menu',
            'invoice_id' => 'required|not in:Open this select menu',
        ];
        $this->validate($request, $rules);
        $invoice = Invoice::find($request->invoice_id);
        $payment = Payment::find($request->payment_id);
        if($payment->remaining > $invoice->amount_unpaid){
            $less_than = $invoice->amount_unpaid;
        }elseif($payment->remaining <= $invoice->amount_unpaid){
            $less_than = $payment->remaining;
        }
        $rules = [
            'amount' => 'required|lte:'.$less_than,
        ];
        $this->validate($request, $rules);
       
        $data = $request->all();
        $payment_item = PaymentItems::create($data);
        return redirect()->route('payments.index');
    }

}
