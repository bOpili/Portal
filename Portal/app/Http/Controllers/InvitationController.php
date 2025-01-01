<?php

namespace App\Http\Controllers;

use App\Models\invitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvitationController extends Controller
{
    public function respondToInvitation(Request $request, $invitationId)
    {
        $invitation = invitation::findOrFail($invitationId);

        // Ensure the receiver is the authenticated user
        if ($invitation->receiver_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Validate the status
        $status = $request->input('status');
        if (!in_array($status, ['accepted', 'declined'])) {
            return response()->json(['message' => 'Invalid status.'], 422);
        }

        // Update the status using collections
        $invitation->update(['status' => $status]);

        return response()->json(['message' => 'Invitation response updated.']);
    }

    public function getReceivedInvitations()
    {
        $user = User::findOrFail(Auth::id());

        // Fetch received invitations with related event and sender using eager loading
        $invitations = $user->receivedInvitations()
            ->with(['event', 'sender'])
            ->get()
            ->map(function ($invitation) {
                return [
                    'id' => $invitation->id,
                    'event_name' => $invitation->event->name,
                    'event_date' => $invitation->event->date,
                    'sender_name' => $invitation->sender->name,
                    'status' => $invitation->status,
                ];
            });
            dd($invitations);
        return response()->json($invitations);
    }
}