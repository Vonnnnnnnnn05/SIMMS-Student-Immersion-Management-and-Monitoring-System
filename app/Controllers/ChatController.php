<?php

namespace App\Controllers;

use App\Models\MessageModel;
use App\Models\UserModel;

class ChatController extends BaseController
{
    protected MessageModel $messageModel;
    protected UserModel $userModel;

    public function __construct()
    {
        $this->messageModel = new MessageModel();
        $this->userModel    = new UserModel();
    }

    public function index()
    {
        $currentUserId = (int) session()->get('user_id');
        $db = \Config\Database::connect();

        // Get available contacts to chat with
        $contacts = $this->userModel
            ->where('user_id !=', $currentUserId)
            ->where('status', 'active')
            ->orderBy('first_name', 'ASC')
            ->findAll();

        $activeContactId = (int) ($this->request->getGet('with') ?? ($contacts[0]['user_id'] ?? 0));
        $activeContact = null;

        $messages = [];
        if ($activeContactId) {
            $activeContact = $this->userModel->find($activeContactId);

            // Fetch conversation history
            $messages = $db->table('messages')
                ->where("(sender_id = {$currentUserId} AND receiver_id = {$activeContactId}) OR (sender_id = {$activeContactId} AND receiver_id = {$currentUserId})")
                ->orderBy('created_at', 'ASC')
                ->get()->getResultArray();

            // Mark unread as read
            $this->messageModel
                ->where('sender_id', $activeContactId)
                ->where('receiver_id', $currentUserId)
                ->set(['is_read' => 1])
                ->update();
        }

        return view('chat/index', [
            'title'           => 'Immersion Messaging & Support Chat',
            'contacts'        => $contacts,
            'activeContact'   => $activeContact,
            'messages'        => $messages,
            'currentUserId'   => $currentUserId,
        ]);
    }

    public function sendMessage()
    {
        $senderId   = (int) session()->get('user_id');
        $receiverId = (int) $this->request->getPost('receiver_id');
        $message    = trim($this->request->getPost('message') ?? '');

        if (empty($message) || ! $receiverId) {
            return redirect()->back()->with('error', 'Message cannot be empty.');
        }

        $this->messageModel->insert([
            'sender_id'   => $senderId,
            'receiver_id' => $receiverId,
            'message'     => $message,
            'is_read'     => 0,
            'created_at'  => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to(base_url('chat?with=' . $receiverId));
    }
}
