<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // if ($request->balance) {
        //     $customers = $customers->where('balance', $request->balance);
        // } else {
        //     $customers = Customer::where('id', '>', 0);
        // }
        
        
        
        // // $customers = Customer::where('id', '>', 0);
        
        // $customers = match($request->sort ?? '') {
        //     'asc_fname' => $customers->orderBy('fname')->orderBy('lname'),
        //     'desc_fname' => $customers->orderBy('fname', 'desc')->orderBy('lname', 'desc'),
        //     'asc_lname' => $customers->orderBy('lname')->orderBy('fname'),
        //     'desc_lname' => $customers->orderBy('lname', 'desc')->orderBy('fname', 'desc'),
        //     'asc_balance' => $customers->orderBy('balance'),
        //     'desc_balance' => $customers->orderBy('balance', 'desc'),
        //     default => $customers->orderBy('lname')->orderBy('fname')
        //     // default => $customers->where('id', '>', 0)
        // };

        // // $customers = $customers->get();
        // $perPageShow = in_array($request->per_page, Customer::PER_PAGE) ? $request->per_page : 'all';
        // if ($perPageShow == 'all') {
        //     $customers = $customers->get();
        // } else {
        //     $customers = $customers->paginate($perPageShow)->withQueryString();
        // }

        // return view('back.customers.index', [
        //     'customers' => $customers,
        //     'sortSelect' => Customer::SORT,
        //     'sortShow' => isset(Customer::SORT[$request->sort]) ? $request->sort : '',
        //     'perPageSelect' => Customer::PER_PAGE,
        //     // 'perPageShow' => isset(Customer::PER_PAGE[$request->per_page]) ? $request->per_page : 'all',
        //     'perPageShow' => in_array($request->per_page, Customer::PER_PAGE) ? $request->per_page : 'all',

        //     'balanceShow' => $request->balance ? $request->balance : '' 
        // ]);

        // Antras variantas:
        
        $perPageShow = in_array($request->per_page, Customer::PER_PAGE) ? $request->per_page : 'all';
        if (!$request->s) {
            
            $customers = Customer::where('id', '>', 0);
            
            $customers = match($request->sort ?? '') {
                'asc_fname' => $customers->orderBy('fname')->orderBy('lname'),
                'desc_fname' => $customers->orderBy('fname', 'desc')->orderBy('lname', 'desc'),
                'asc_lname' => $customers->orderBy('lname')->orderBy('fname'),
                'desc_lname' => $customers->orderBy('lname', 'desc')->orderBy('fname', 'desc'),
                'asc_balance' => $customers->orderBy('balance'),
                'desc_balance' => $customers->orderBy('balance', 'desc'),
                default => $customers->orderBy('lname')->orderBy('fname')
                // default => $customers->where('id', '>', 0)
            };

            // $customers = $customers->get();
            
            if ($perPageShow == 'all') {
                $customers = $customers->get();
            } else {
                $customers = $customers->paginate($perPageShow)->withQueryString();
            }
        }
        else {
            // $customers = Customer::where('balance', 'like', '%'.$request->s.'%')->get();
            $customers = Customer::where('balance', 'like', $request->s)->get();
        }

        return view('back.customers.index', [
            'customers' => $customers,
            'sortSelect' => Customer::SORT,
            'sortShow' => isset(Customer::SORT[$request->sort]) ? $request->sort : '',
            'perPageSelect' => Customer::PER_PAGE,
            // 'perPageShow' => isset(Customer::PER_PAGE[$request->per_page]) ? $request->per_page : 'all',
            'perPageShow' => $perPageShow,
            's' => $request->s ?? ''
        ]);
        
        // Pirmas variantas:
        // $customers = Customer::all()->sortBy('fname')->sortBy('lname');
        // return view('back.customers.index', [
        //     'customers' => $customers
        // ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make(
            $request->all(), 
            [
            'customer_fname' => 'required|alpha|min:4|max:100',
            'customer_lname' => 'required|alpha|min:4|max:100',
            'customer_code' => 'required|integer|unique:customers,code|regex:/^([3-6]{1})([0-9]{2})([0-1]{1})([0-9]{1})([0-3]{1})([0-9]{1})([0-9999]{4})$/',
            // 'customer_code' => 'required|integer|min:11|max:11|unique:customers,code|regex:/^([1-6]{1})([0-9]{2})([0-1]{1})([0-9]{1})([0-3]{1})([0-9]{1})([0-9999]{4})$/',
            // 'customer_code' => 'required|numeric|max:100',
            // 'sum_x' => 'required|numeric|max:100',
            // 'sum_y' => 'required|numeric|max:100',
            // ],
            // [
            //     'sum_x.required' => 'Nu kažką praleidai',
            //     'sum_y.required' => 'Nu kažką praleidai',
            //     'sum_x.numeric' => 'Raidės ne skaičiai',
            //     'sum_y.numeric' => 'Raidės ne skaičiai',
            //     'sum_x.max' => 'Nu labai jau daug',
            //     'sum_y.max' => 'Nu labai jau daug',
            ]);
            
            // $request->flash();
            
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }

        // $validator->after(function ($validator) use ($request) {
        //     if ($request->customer_code.[0] < 3 || $request->customer_code.[0] > 6) {
        //         $validator->errors()->add(
        //             'code', 'Invalid personal code!'
        //         );
        //     }
        //     if ($request->customer_code.[3] > 1) {
        //         $validator->errors()->add(
        //             'code', 'Invalid personal code!'
        //         );
        //     }
        //     if ($request->customer_code.[3] == 1 && $request->customer_code.[4] > 2) {
        //         $validator->errors()->add(
        //             'code', 'Invalid personal code!'
        //         );
        //     }
        // });

        // $validator->after(function ($validator) use ($request) {
        //     if ($request->sum_x + $request->sum_y > 150) {
        //         $validator->errors()->add(
        //             'x_y', 'Sum is to big!'
        //         );
        //     }
        // });
        
        $customer = new Customer;
        $customer->fname = $request->customer_fname;
        $customer->lname = $request->customer_lname;
        $customer->code = $request->customer_code;
        $customer->account_code = 'LT' . rand(0, 9) . rand(0, 9) . '-' . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . '-' . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . '-' . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . '-' . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) ;
        $customer->balance = 0;
        $customer->save();

        return redirect()->route('customers-index')->with('ok', 'New customer was created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('back.customers.edit', [
            'customer' => $customer
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $customer->fname = $request->customer_fname;
        $customer->lname = $request->customer_lname;
        $customer->code = $request->customer_code;
        $customer->save();

        return redirect()->route('customers-index');
    }

    public function add(Customer $customer)
    {
        return view('back.customers.add', [
            'customer' => $customer
        ]);
    }

    public function updateAdd(Request $request, Customer $customer)
    {
        $validator = Validator::make(
            $request->all(), 
            [
            'balance' => 'numeric|min:0',
            ],
            [
                'balance.numeric' => 'There should be numbers!',
                'balance.min' => 'Number must be positive!',
            ]);
            
            $request->flash();
            
            if ($validator->fails()) {
                // $request->flash();
                return redirect()->back()->withErrors($validator);
            }

        // $validator->after(function ($validator) use ($request) {
        //     if ($customer->balance + $request->balance > 999999.99) {
        //         $validator->errors()->add(
        //             'no', 'Sum is to big!'
        //         );
        //     }
        // });
        
        // $validator->after(function ($validator) use ($request) {
        //     if ($request->sum_x + $request->sum_y > 150) {
        //         $validator->errors()->add(
        //             'x_y', 'Sum is to big!'
        //         );
        //     }
        // });
        //ВЕРНУТЬ!!!!!:
        
        // $customer->balance = $customer->balance + $request->balance;
        // $customer->save();
        // return redirect()->back()->with('ok', 'Customer balance successfully increased!');
        
        
        // return view('back.customers.add', [
        //     'customer' => $customer
        // ]);


        // $customer->balance = $customer->balance + $request->balance;
        // $customer->save();
        // return redirect()->back()->with('ok', 'Customer balance successfully increased!');
        // return view('back.customers.add', [
        //     'customer' => $customer
        // ]);

        if ($customer->balance + $request->balance > 999999.) {
            return redirect()->back()->with('no', 'Sum is to big!');
        } else {
            $customer->balance = $customer->balance + $request->balance;
            $customer->save();
            return redirect()->back()->with('ok', 'Transaction completed successfully!');
        }
    }

    public function withdraw(Customer $customer)
    {
        return view('back.customers.withdraw', [
            'customer' => $customer
        ]);
    }

    public function updateWithdraw(Request $request, Customer $customer)
    {
        
        $validator = Validator::make(
            $request->all(), 
            [
            'balance' => 'numeric|min:0',
            ],
            [
                'balance.numeric' => 'There should be numbers!',
                'balance.min' => 'Number must be positive!',
            ]);
            
            $request->flash();
            
            if ($validator->fails()) {
                // $request->flash();
                return redirect()->back()->withErrors($validator);
            }

        // $validator->after(function ($validator) use ($request) {
        //     if ($request->sum_x + $request->sum_y > 150) {
        //         $validator->errors()->add(
        //             'x_y', 'Sum is to big!'
        //         );
        //     }
        // });

        if ($customer->balance >= $request->balance) {
            $customer->balance = $customer->balance - $request->balance;
        $customer->save();
        return redirect()->back()->with('ok', 'Transaction completed successfully!');
        } else {
            return redirect()->back()->with('no', 'Not enough money in the bank account!');
        }
        
        // $customer->balance = $customer->balance - $request->balance;
        // $customer->save();
        // // return redirect()->route('customers-index');
        // return view('back.customers.withdraw', [
        //     'customer' => $customer
        // ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        if ($customer->balance == 0) {
            $customer->delete();
            return redirect()->route('customers-index')->with('ok', 'Account was deleted');
        }

        return redirect()->back()->with('no', 'You can not delete the account if the balance is positive');

        // $customer->delete();
        // return redirect()->route('customers-index');
    }
}