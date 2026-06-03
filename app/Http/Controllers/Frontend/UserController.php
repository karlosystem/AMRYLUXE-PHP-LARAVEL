<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Component\Mime\Message;
use App\Models\User;
use App\Models\Order;
use App\Models\Producto;
use App\Models\OrderItem;
use App\Models\Review;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profileUpdate(Request $request)
    {
        // Get authenticated user
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Validate input data
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'zipcode' => 'nullable|string|max:20',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // 2MB max
        ]);

        try {
            // Handle image upload
            if ($request->hasFile('image')) {
                // Define the new image path
                $destinationPath = public_path('front/assets/images/avatar/');

                // Ensure the directory exists
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                // Delete old image if it exists
                if ($user->image && file_exists($destinationPath . $user->image)) {
                    unlink($destinationPath . $user->image);
                }

                // Store new image
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move($destinationPath, $imageName);

                // Save new image name to database
                $user->image = $imageName;
            }

            // Update user data
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->zipcode = $request->zipcode;

            $user->save();
        } catch (\Exception $e) {
            // Log the error message with stack trace
            Log::error('Profile update failed: ' . $e->getMessage(), [
                'exception' => $e
            ]);

            // Opcional: retornar con un error para el usuario
            return back()->with('error', 'Ocurrió un error al actualizar el perfil.');
        }
        return redirect()->back()->with('success', 'Perfil de usuario actualizado con éxito.');
    }


    public function index()
    {
        return view('front.user.profile');
    }

    public function edit()
    {
        return view('front.user.edit');
    }

    public function orders()
    {
        // order status : pending,processing,shipped,delivered,cancelled
        $orders = Order::with('orderItems')->where('user_id', Auth::user()->id)->get(); // todos
        $deliveredOrders = Order::with('orderItems')->where('user_id', Auth::user()->id)->where('order_status', 'delivered')->get();
        $canceladosOrders = Order::with('orderItems')->where('user_id', Auth::user()->id)->where('order_status', 'cancelled')->get();

        return view('front.user.orders', compact('orders', 'deliveredOrders', 'canceladosOrders'));
    }

    public function orderDetails($id)
    {
        $order = Order::with('orderItems')->findOrFail($id);
        return view('front.user.order-details', compact('order'));
    }

    public function reviews()
    {
        $reviews = Review::with('products')->where('user_id', Auth::user()->id)->get();
        return view('front.user.reviews', compact('reviews'));
    }

    public function changePassword(Request $request)
    {
        // Validate input
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Check if current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password is incorrect.');
        }

        // Update the password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password changed successfully!');
    }
}
