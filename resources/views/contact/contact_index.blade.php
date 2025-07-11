@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">Contact Submissions</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-success">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Send From</th>
                        <th>Message</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $contact)
                        <tr>
                            <td>{{ $contact->id }}</td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ ucfirst($contact->Send_from) }}</td>
                            <td>{{ Str::limit($contact->message, 60) }}</td>
                            <td>
                                <!-- View Conversation Button -->
                                <button class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#conversationModal" data-contact-id="{{ $contact->id }}">
                                    View
                                </button>

                                <!-- Reply Button -->
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#replyModal"
                                    data-contact-id="{{ $contact->id }}" data-contact-name="{{ $contact->name }}"
                                    data-contact-email="{{ $contact->email }}">
                                    Reply
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No contact submissions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Conversation Modal -->
    <div class="modal fade" id="conversationModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Conversation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                    <div id="conversationContainer">
                        <p class="text-center">Loading conversation...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reply Modal (as you already had) -->
    <div class="modal fade" id="replyModal" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" action="" id="replyForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reply to <span id="contactName"></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" id="contactEmail" class="form-control" readonly>
                        </div>

                        <div class="mb-3">
                            <label>Reply Message</label>
                            <textarea name="reply_message" rows="4" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Send Reply</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Load Conversation in View Modal
        const conversationModal = document.getElementById('conversationModal');
        conversationModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const contactId = button.getAttribute('data-contact-id');

            fetch(`/admin/contacts/${contactId}/conversation`)
                .then(response => response.json())
                .then(messages => {
                    const container = document.getElementById('conversationContainer');
                    container.innerHTML = '';

                    if (!messages.length) {
                        container.innerHTML = '<p class="text-muted text-center">No conversation found.</p>';
                    } else {
                        messages.forEach(msg => {
                            const msgDiv = document.createElement('div');
                            msgDiv.className = 'mb-3 p-2 rounded';
                            msgDiv.style.backgroundColor = msg.Send_from === 'admin' ? '#e8f5e9' :
                                '#fce4ec';
                            msgDiv.innerHTML = `
                            <strong>${msg.Send_from === 'admin' ? 'Admin' : msg.name}:</strong>
                            <p>${msg.message}</p>
                            <small class="text-muted">${new Date(msg.created_at).toLocaleString()}</small>
                        `;
                            container.appendChild(msgDiv);
                        });
                    }
                })
                .catch(() => {
                    document.getElementById('conversationContainer').innerHTML =
                        '<p class="text-danger text-center">Error loading messages.</p>';
                });
        });

        // Reply Modal Script
        const replyModal = document.getElementById('replyModal');
        replyModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const contactId = button.getAttribute('data-contact-id');
            const contactName = button.getAttribute('data-contact-name');
            const contactEmail = button.getAttribute('data-contact-email');

            document.getElementById('contactName').textContent = contactName;
            document.getElementById('contactEmail').value = contactEmail;

            document.getElementById('replyForm').action = `/admin/contacts/${contactId}/reply`;
        });
    </script>
@endsection
