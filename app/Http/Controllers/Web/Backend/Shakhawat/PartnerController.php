<?php

namespace App\Http\Controllers\Web\Backend\Shakhawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partner;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ImageService;

class PartnerController extends Controller
{
    public function getData(Request $request)
    {
        $data = Partner::latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()

            ->addColumn('company_name', function ($row) {
                return $row->company_name;
            })

            ->addColumn('short_description', function ($row) {
                return $row->short_description;
            })

            ->addColumn('logo', function ($row) {
                $url = $row->logo ? asset($row->logo) : asset('admin/assets/images/default.png');
                return '<img src="' . $url . '" class="rounded" width="50" height="50" style="object-fit: cover;" />';
            })

            ->addColumn('status', function ($row) {
                return (int) $row->status;
            })

            ->rawColumns(['logo', 'status'])
            ->make(true);
    }

    public function index()
    {
        try {
            $partners = Partner::all();
            return view('backend.layouts.partner.index', compact('partners'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to retrieve partners.');
        }
    }

    public function create()
    {
        try {
            return view('backend.layouts.partner.create');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load partner creation form.');
        }
    }

    public function store(Request $request, ImageService $imageService)
    {
        $request->validate([
            'company_name' => 'nullable|string|max:255',
            'short_description' => 'nullable|string|max:10000',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'status' => 'nullable|boolean',
        ]);

        try {
            $partner = new Partner();
            $partner->company_name = $request->company_name;
            $partner->short_description = $request->short_description;
            $partner->status = $request->status ?? 1;

            if ($request->hasFile('logo')) {
                $imagePath = $imageService->uploadImage($request->file('logo'), 'uploads/partners');
                $partner->logo = $imagePath;
            }

            $partner->save();

            return redirect()->route('partners.index')->with('success', 'Partner created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to create partner.');
        }
    }

    public function edit($id)
    {
        try {
            $partner = Partner::findOrFail($id);
            return view('backend.layouts.partner.edit', compact('partner'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load partner edit form.');
        }
    }

    public function update(Request $request, $id, ImageService $imageService)
    {
        $request->validate([
            'company_name' => 'nullable|string|max:255',
            'short_description' => 'nullable|string|max:10000',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'status' => 'nullable|boolean',
        ]);

        try {
            $partner = Partner::findOrFail($id);
            $partner->company_name = $request->company_name;
            $partner->short_description = $request->short_description;
            $partner->status = $request->status ?? 1;

            if ($request->hasFile('logo')) {
                $imagePath = $imageService->uploadImage($request->file('logo'), 'uploads/partners');
                $partner->logo = $imagePath;
            }

            $partner->save();

            return redirect()->route('partners.index')->with('success', 'Partner updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update partner.');
        }
    }

    public function UpdateStatus(Request $request, $id)
    {
        try {
            $partner = Partner::findOrFail($id);
            $partner->status = $request->status;
            $partner->save();

            return response()->json(['success' => true, 'message' => 'Partner status updated successfully.']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update partner status.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $partner = Partner::findOrFail($id);
            $partner->delete();

            return redirect()->route('partners.index')->with('success', 'Partner deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete partner.');
        }
    }
}
