<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Header Section -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-xl font-bold text-[#1B365D] tracking-tight">Immersion Communications & Chat</h1>
        <p class="text-xs text-slate-500 mt-1">Sprint 9: Real-time database messaging between students, faculty coordinators, and host supervisors</p>
    </div>
</div>

<!-- Chat Container Card -->
<div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] overflow-hidden flex flex-col md:flex-row" style="height: calc(100vh - 220px); min-height: 520px;">
    <!-- Contacts Sidebar -->
    <div class="w-full md:w-72 border-r border-slate-200 flex flex-col bg-slate-50/50 shrink-0 h-full" style="flex-shrink: 0;">
        <div class="p-4 border-b border-slate-200 bg-white flex items-center justify-between">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Conversations</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600"><?= count($contacts) ?></span>
        </div>

        <div class="overflow-y-auto flex-1 divide-y divide-slate-100">
            <?php if (empty($contacts)): ?>
                <div class="p-6 text-center text-xs text-slate-400">No other registered accounts found.</div>
            <?php else: ?>
                <?php foreach ($contacts as $c): ?>
                    <?php $isActive = ($activeContact && $activeContact['user_id'] == $c['user_id']); ?>
                    <a href="<?= base_url('chat?with=' . $c['user_id']) ?>" class="p-3.5 flex items-center gap-3 transition-colors <?= $isActive ? 'bg-white border-l-4 border-l-[#1B365D] shadow-xs' : 'hover:bg-slate-100/70' ?>">
                        <div class="w-9 h-9 rounded-full bg-[#1B365D] text-[#E5A93C] font-bold text-xs flex items-center justify-center shrink-0">
                            <?= esc(strtoupper(substr($c['first_name'], 0, 1))) ?>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-xs font-bold text-[#1B365D] truncate"><?= esc($c['first_name'] . ' ' . $c['last_name']) ?></div>
                            <div class="flex items-center gap-1.5 mt-0.5">
                                <?php
                                    $roleBadgeClasses = [
                                        'admin'   => 'bg-purple-50 text-purple-700 border border-purple-200',
                                        'faculty' => 'bg-blue-50 text-blue-700 border border-blue-200',
                                        'student' => 'bg-emerald-50 text-emerald-700 border border-emerald-200',
                                        'agency'  => 'bg-amber-50 text-amber-700 border border-amber-200',
                                    ];
                                    $roleBadge = $roleBadgeClasses[$c['role']] ?? 'bg-slate-100 text-slate-700 border border-slate-200';
                                ?>
                                <span class="inline-block px-1.5 py-0.2 text-[9px] font-bold rounded uppercase tracking-wider <?= $roleBadge ?>">
                                    <?= esc($c['role']) ?>
                                </span>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Active Conversation Window -->
    <div class="flex-1 flex flex-col bg-white">
        <?php if ($activeContact): ?>
            <!-- Conversation Header -->
            <div class="p-4 border-b border-slate-200 flex items-center justify-between bg-slate-50/30">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-[#1B365D] text-[#E5A93C] font-bold text-xs flex items-center justify-center shrink-0">
                        <?= esc(strtoupper(substr($activeContact['first_name'], 0, 1))) ?>
                    </div>
                    <div>
                        <div class="text-xs font-bold text-[#1B365D]"><?= esc($activeContact['first_name'] . ' ' . $activeContact['last_name']) ?></div>
                        <div class="text-[11px] text-slate-400"><?= esc($activeContact['email']) ?> &bull; <?= strtoupper($activeContact['role']) ?></div>
                    </div>
                </div>
            </div>

            <!-- Messages Stream -->
            <div class="flex-1 p-5 overflow-y-auto space-y-3.5" id="messageStream">
                <?php if (empty($messages)): ?>
                    <div class="h-full flex flex-col items-center justify-center text-center text-slate-400 my-auto">
                        <svg class="w-10 h-10 mb-2 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a.75.75 0 01-1.074-.85 6.002 6.002 0 001.378-3.082C4.184 15.65 3 13.926 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z"/></svg>
                        <p class="text-xs">No previous message history. Send a message to start communicating!</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($messages as $msg): ?>
                        <?php $isMine = ($msg['sender_id'] == $currentUserId); ?>
                        <div class="flex <?= $isMine ? 'justify-end' : 'justify-start' ?>">
                            <div class="max-w-md rounded-2xl px-4 py-2.5 text-xs shadow-2xs <?= $isMine ? 'bg-[#1B365D] text-white rounded-br-xs' : 'bg-slate-100 text-[#1B365D] rounded-bl-xs' ?>">
                                <div class="leading-relaxed"><?= esc($msg['message']) ?></div>
                                <div class="text-[10px] mt-1 <?= $isMine ? 'text-white/60 text-right' : 'text-slate-400 text-left' ?>">
                                    <?= date('h:i A &bull; M d', strtotime($msg['created_at'])) ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Message Input Form -->
            <div class="p-3.5 border-t border-slate-200 bg-slate-50/50">
                <form action="<?= base_url('chat/send') ?>" method="POST" class="flex gap-2">
                    <?= csrf_field() ?>
                    <input type="hidden" name="receiver_id" value="<?= $activeContact['user_id'] ?>">
                    <input type="text" name="message" class="flex-1 bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]" placeholder="Type your message here..." required autofocus autocomplete="off">
                    <button type="submit" class="px-4 py-2.5 rounded-xl text-xs font-bold bg-[#E5A93C] hover:bg-[#d4962b] text-[#1B365D] shadow-2xs transition-colors cursor-pointer border-0 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/></svg>
                    </button>
                </form>
            </div>
        <?php else: ?>
            <div class="h-full flex flex-col items-center justify-center text-center text-slate-400 p-8">
                <svg class="w-12 h-12 mb-3 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a.75.75 0 01-1.074-.85 6.002 6.002 0 001.378-3.082C4.184 15.65 3 13.926 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z"/></svg>
                <div class="text-sm font-semibold text-slate-600">Select a contact to begin messaging</div>
                <p class="text-xs text-slate-400 mt-1">Choose an advisee, coordinator, or supervisor from the list</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
window.addEventListener('load', function() {
    const stream = document.getElementById('messageStream');
    if (stream) {
        stream.scrollTop = stream.scrollHeight;
    }
});
</script>
<?= $this->endSection() ?>
