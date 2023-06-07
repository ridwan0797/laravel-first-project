<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\SocialMedia;
use Illuminate\Support\Facades\Validator;


class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with('socialMedia')->get();

        return response()->json($customers);
    }


   public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), config('validation.custom_rules'));

            if ($validator->fails()) {
                $errors = $validator->getMessageBag()->toArray();
                $status = 400; // HTTP status code 400 - Bad Request
                $message = 'Validation failed: Some fields are invalid';
                return response()->json(['message' => $message, 'errors' => $errors], $status);
            }

            $customer = Customer::create($request->all());
            $status = 201; // HTTP status code 201 - Created
            $message = 'Customer created successfully'; // Custom status message

             // Simpan social media dengan relasi ke employee
            $socialMediaData = $request->input('social_media');

            foreach ($socialMediaData as $socialMediaItem) {
                $socialMedia = new SocialMedia([
                    'social_media_name' => $socialMediaItem['social_media_name'],
                    'username' => $socialMediaItem['username'],
                ]);

                $customer->socialMedia()->save($socialMedia);
            }

            return response()->json($customer, $status)->header('Status-Text', $message);
        } catch (\Exception $e) {
            // Menampilkan informasi error yang lebih rinci
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }


    public function show(Customer $customer)
    {
        $customerWithSocialMedia = Customer::with('socialMedia')->find($customer->id);
        
        return response()->json($customerWithSocialMedia);
    }


    public function update(Request $request, Customer $customer)
    {
        $customer->update($request->all());
        return response()->json($customer);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->json(null, 204);
    }
}