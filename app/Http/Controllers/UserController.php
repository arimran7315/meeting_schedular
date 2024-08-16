<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   public function calender(Request $request)
   {
      $userId = Auth::id();
      date_default_timezone_set('Asia/Karachi');

      $ym = $request->input('ym', date('Y-m'));
      $timestamp = strtotime($ym . '-01');
      if ($timestamp === false) {
         $timestamp = time();
      }

      $date = date('Y-m-d', $timestamp);
      $today = date('Y-m-d', time());
      $htmlTitle = date('Y', $timestamp);
      $month = date('m', $timestamp);
      $htmlTitleMonth = date('F', $timestamp);
      $prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp) - 1, 1, date('Y', $timestamp)));
      $next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp) + 1, 1, date('Y', $timestamp)));
      $dayCount = date('t', $timestamp);
      $str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));

      $weeks = [];
      $week = '';

      $week .= str_repeat("<td></td>", $str);

      for ($day = 1; $day <= $dayCount; $day++, $str++) {
         $date = $ym . '-' . $day;

         $week .= "<td class='text-start'><div class='ps-2'>" . $day . "</div><div class='py-3'></div>";

         $notifications = DB::table('notifications')
            ->join('meetings', 'notifications.meeting_id', '=', 'meetings.id')
            ->where('notifications.user_id', $userId)
            ->whereYear('meetings.meet_date', $htmlTitle)
            ->whereMonth('meetings.meet_date', $month)
            ->whereNotIn('notifications.status', [0, 1, 3])
            ->get();

         foreach ($notifications as $notification) {
            $createdAt = $notification->meet_date;
            $dday = date('d', strtotime($createdAt));
            if ($dday == $day) {
               $week .= "<div class='mt-2'><a href='" . route('meeting.show',  $notification->meeting_id) . "' class='btn btn-success btn-sm'> " . $notification->title . "</a></div>";
            }
         }

         $week .= '</td>';

         if ($str % 7 == 6 || $day == $dayCount) {
            if ($day == $dayCount) {
               $week .= str_repeat("<td></td>", 6 - ($str % 7));
            }
            $weeks[] = '<tr>' . $week . '</tr>';
            $week = '';
         }
      }

      return view('index', compact('htmlTitle', 'htmlTitleMonth', 'prev', 'next', 'weeks', 'today'));
   }
   public function updateInformation(Request $request)
   {
      User::whereId(Auth::user()->id)->update([
         'name' => $request->name,
         'contact' => $request->cell,
         'address' => $request->address
      ]);
      return redirect()->back()->with([
         'type' => 'success',
         'message' => 'Information updated successfully',
      ]);
   }

   public function updateImage(Request $request){
      $request->validate([
         'profile' => 'required',
      ],[
         'profile.required' => 'Field is required',
      ]);
      $image_path = public_path("/storage/").$request->profile;
      if(file_exists($image_path)){
          @unlink($image_path);
      }
      $path = $request->file('profile')->store('users','public');
      User::whereId(Auth::user()->id)->update([
         'image' => $path
      ]);
      return redirect()->back()->with([
         'type' => 'success',
         'message' => 'Update Image Successfully'
      ]);
   }
   public function updatePassword(Request $request)
   {
      $password = $request->validate([
         // 'old_pass' => 'required',
         'password' => 'required|confirmed',
      ], [
         // 'old_pass.required' => 'Field is required',
         'password.required' => 'Field is required',
         'password.confirmed' => 'Password does not matched',
      ]);
      // Update the password
      $user = Auth::user();
      $user->password = Hash::make($request->password);
      $user->save();
      return redirect()->back()->with([
         'type' => 'success',
         'message' => 'Pasword updated successfully',
      ]);
   }
   public function register(Request $request)
   {
      $user = $request->validate([
         'name' => 'required',
         'email' => 'required|email|unique:users,email',
         'password' => 'required|confirmed'
      ], [
         'name.required' => 'Field Is Required',
         'email.required' => 'Field Is Required',
         'email.email' => 'Field must be a valid email',
         'email.unique' => 'Email already exists',
         'password.required' => 'Field Is Required',
         'password.confirmed' => 'Field Is not Matched',
      ]);

      User::create($user);
      return redirect()->route('loginPage')->with([
         'type' => 'primary',
         'message' => 'Acount Registered Successfully'
      ]);
   }
   public function login(Request $request)
   {
      $date = date('Y-m-d');
      $user = $request->validate([
         'email' => 'required|email',
         'password' => 'required'
      ], [
         'email.required' => 'Field Is Required',
         'email.email' => 'Field must be a valid email',
         'password.required' => 'Field Is Required',
      ]);
      if (Auth::attempt($user)) {
         return redirect()->route('index');
      } else {
         return back()->with([
            'type' => 'danger',
            'message' => 'Invalid Credentials'
         ]);
      }
   }
   public function logout()
   {
      Auth::logout();
      return redirect()->route('loginPage');
   }
}
