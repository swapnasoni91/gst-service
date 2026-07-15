<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanySetting;
use Illuminate\Support\Facades\Auth;

class CompanySettingController extends Controller
{
    public function index()
    {
        $setting = CompanySetting::where('user_id', Auth::id())
                    ->first();

        return view('company_settings.index', compact('setting'));
    }

    public function create()
    {
        $setting = CompanySetting::where(
            'user_id',
            Auth::id()
        )->first();

        if($setting){

            return redirect()
                ->route('company-settings.index');

        }

        return view('company_settings.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'company_name' => 'required',
            'state' => 'required',
            'gst_number' => 'required',

            'company_logo' =>
                'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ]);

        $logo = null;
        // LOGO UPLOAD
        if($request->hasFile('company_logo')){

            $logo = time() . '.' .
                $request->company_logo->extension();

            $request->company_logo->move(
                public_path('uploads/company'),
                $logo
            );

        }

        CompanySetting::create([

            'user_id' => Auth::id(),

            'company_name' => $request->company_name,

            'company_logo' => $logo,

            'gst_number' => $request->gst_number,

            'state' => $request->state,

            'phone' => $request->phone,

            'address' => $request->address,

        ]);

        return redirect()
            ->route('company-settings.index')
            ->with(
                'success',
                'Company Settings Saved'
            );
    }

    // EDIT FORM
    public function edit($id)
    {
        $setting = CompanySetting::where(
            'user_id',
            Auth::id()
        )->findOrFail($id);

        return view(
            'company_settings.edit',
            compact('setting')
        );
    }

    // UPDATE SETTINGS
    public function update(
        Request $request,
        $id
    )
    {
        $setting = CompanySetting::where(
            'user_id',
            Auth::id()
        )->findOrFail($id);

        $request->validate([

            'company_name' => 'required',
            'state' => 'required',

        ]);

        $logo = $setting->company_logo;

        // NEW LOGO
        if($request->hasFile('company_logo')){

            $logo = time() . '.' .
                $request->company_logo->extension();

            $request->company_logo->move(
                public_path('uploads/company'),
                $logo
            );

        }

        $setting->update([

            'company_name' => $request->company_name,

            'company_logo' => $logo,

            'gst_number' => $request->gst_number,

            'state' => $request->state,

            'phone' => $request->phone,

            'address' => $request->address,

        ]);

        return redirect()
            ->route('company-settings.index')
            ->with(
                'success',
                'Company Settings Updated'
            );
    }
}