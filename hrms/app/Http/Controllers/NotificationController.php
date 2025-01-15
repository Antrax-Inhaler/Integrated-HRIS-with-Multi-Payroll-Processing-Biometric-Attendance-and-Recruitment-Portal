<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
class NotificationController extends Controller
{
    /**
     * Fetch notifications for admin users only.
     *
     * @return JsonResponse
     */
    public function getAdminNotifications(): JsonResponse
    {
        // Fetch notifications where user_type is 'admin' and is_read_admin is 0 (unread)
        $notifications = Notification::where('user_type', 'admin')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($notifications);
    }

    /**
     * Mark an admin notification as read.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function markAsRead($id)
    {
        $notification = Notification::find($id);
        if ($notification && $notification->user_type === 'admin') {
            $notification->is_read_admin = true;
            $notification->save();
    
            return response()->json(['success' => true]);
        }
    
        return response()->json(['success' => false], 404);
    }
    
    public function getMemberNotifications(): JsonResponse
    {
        // Fetch notifications for logged-in members where is_read is 0 (unread)
        $notifications = Notification::where('user_type', 'member')
            ->where('user_id', Auth::id())
            ->where('message', 'NOT LIKE', '%You have successfully logged%') // Exclude specific message
            ->orderBy('created_at', 'desc')
            ->get();
    
        return response()->json($notifications);
    }
    

    /**
     * Mark a member notification as read.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function markMemberNotificationAsRead($id): JsonResponse
    {
        $notification = Notification::where('id', $id)
            ->where('user_type', 'member')
            ->where('user_id', Auth::id())
            ->first();
    
        if ($notification) {
            $notification->is_read = true; // Ensure this field is updated
            $notification->save();
    
            return response()->json(['success' => true]);
        }
    
        return response()->json(['success' => false], 404);
    }
    public function getApplicantNotifications(): JsonResponse
{
    // Fetch notifications for logged-in applicants where is_read is 0 (unread)
    $notifications = Notification::where('user_type', 'applicant')
        ->where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->get();

    return response()->json($notifications);
}

/**
 * Mark an applicant notification as read.
 *
 * @param int $id
 * @return JsonResponse
 */
public function markApplicantNotificationAsRead($id): JsonResponse
{
    $notification = Notification::where('id', $id)
        ->where('user_type', 'applicant')
        ->where('user_id', Auth::id())
        ->first();

    if ($notification) {
        $notification->is_read = true; // Mark the notification as read
        $notification->save();

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false], 404);
}
}
