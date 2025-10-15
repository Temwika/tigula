@extends('layouts.app', ['activeMenu' => 'audit-logs'])

@section('title', 'Audit Logs - Tigula')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <div class="page-header-content">
            <h1>Audit Logs</h1>
            <p>Track all system activities and changes</p>
        </div>
    </div>

    <!-- Filters -->
    <div class="filters-section">
        <form method="GET" class="filters-form">
            <div class="filter-row">
                <div class="filter-group">
                    <label for="action">Action</label>
                    <select name="action" id="action" class="form-control">
                        <option value="">All Actions</option>
                        @foreach($actions as $action)
                        <option value="{{ $action }}" {{ request('action') == $action ? 'selected' : '' }}>
                            {{ ucfirst($action) }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-group">
                    <label for="user_id">User</label>
                    <select name="user_id" id="user_id" class="form-control">
                        <option value="">All Users</option>
                        @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-group">
                    <label for="model_type">Resource Type</label>
                    <select name="model_type" id="model_type" class="form-control">
                        <option value="">All Types</option>
                        @foreach($modelTypes as $modelType)
                        <option value="{{ $modelType }}" {{ request('model_type') == $modelType ? 'selected' : '' }}>
                            {{ class_basename($modelType) }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-group">
                    <label for="start_date">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="form-control"
                           value="{{ request('start_date') }}">
                </div>

                <div class="filter-group">
                    <label for="end_date">End Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control"
                           value="{{ request('end_date') }}">
                </div>

                <div class="filter-group">
                    <label>&nbsp;</label>
                    <div class="filter-buttons">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('audit-logs.index') }}" class="btn btn-secondary">Clear</a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Audit Logs Table -->
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Timestamp</th>
                    <th>User</th>
                    <th>Action</th>
                    <th>Resource</th>
                    <th>Details</th>
                    <th>Changes</th>
                </tr>
            </thead>
            <tbody>
                @forelse($auditLogs as $log)
                <tr>
                    <td>
                        <div class="timestamp">
                            <div class="date">{{ $log->created_at->format('M j, Y') }}</div>
                            <div class="time">{{ $log->created_at->format('H:i:s') }}</div>
                        </div>
                    </td>
                    <td>
                        @if($log->user)
                            <div class="user-info">
                                <div class="user-name">{{ $log->user->name }}</div>
                                <div class="user-role">{{ ucfirst($log->user->role) }}</div>
                            </div>
                        @else
                            <span class="text-muted">System</span>
                        @endif
                    </td>
                    <td>
                        <span class="action-badge action-{{ strtolower($log->action) }}">
                            {{ $log->formatted_action }}
                        </span>
                    </td>
                    <td>
                        <div class="resource-info">
                            <div class="resource-type">{{ $log->formatted_model }}</div>
                            <div class="resource-id">ID: {{ $log->model_id }}</div>
                        </div>
                    </td>
                    <td>
                        @if($log->notes)
                            <span class="notes">{{ $log->notes }}</span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        @if($log->changes)
                            <button class="btn btn-sm btn-outline-primary view-changes"
                                    data-changes="{{ json_encode($log->changes) }}">
                                View Changes
                            </button>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="no-data">
                        <i class="fas fa-history"></i>
                        <p>No audit logs found matching your criteria.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($auditLogs->hasPages())
    <div class="pagination-wrapper">
        {{ $auditLogs->appends(request()->query())->links() }}
    </div>
    @endif
</div>

<!-- Changes Modal -->
<div id="changesModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Audit Log Changes</h3>
            <button type="button" class="close-modal">&times;</button>
        </div>
        <div class="modal-body">
            <div id="changesContent">
                <!-- Changes will be loaded here -->
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.content-wrapper {
    padding: 1.5rem;
}

.page-header {
    margin-bottom: 2rem;
}

.page-header h1 {
    color: #2d6a4f;
    font-size: 1.8rem;
    margin-bottom: 0.5rem;
}

.page-header p {
    color: #666;
    margin: 0;
}

.filters-section {
    background: #fff;
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.filters-form .filter-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    align-items: end;
}

.filter-group label {
    display: block;
    font-weight: 600;
    color: #333;
    margin-bottom: 0.5rem;
}

.form-control {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 0.9rem;
}

.form-control:focus {
    outline: none;
    border-color: #2d6a4f;
    box-shadow: 0 0 0 3px rgba(45, 106, 79, 0.1);
}

.filter-buttons {
    display: flex;
    gap: 0.5rem;
}

.btn {
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 6px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    text-align: center;
}

.btn-primary {
    background: linear-gradient(135deg, #2d6a4f 0%, #ff6600 100%);
    color: #fff;
}

.btn-secondary {
    background: #6c757d;
    color: #fff;
}

.btn-outline-primary {
    background: transparent;
    color: #2d6a4f;
    border: 1px solid #2d6a4f;
}

.table-container {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.data-table {
    width: 100%;
    border-collapse: collapse;
}

.data-table thead th {
    background: #f8f9fa;
    padding: 1rem;
    text-align: left;
    font-weight: 600;
    color: #333;
    border-bottom: 1px solid #dee2e6;
}

.data-table tbody td {
    padding: 1rem;
    border-bottom: 1px solid #f1f3f4;
    vertical-align: top;
}

.timestamp .date {
    font-weight: 600;
    color: #333;
}

.timestamp .time {
    color: #666;
    font-size: 0.8rem;
}

.user-info .user-name {
    font-weight: 600;
    color: #333;
}

.user-info .user-role {
    color: #666;
    font-size: 0.8rem;
}

.action-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
}

.action-created { background: #d4edda; color: #155724; }
.action-updated { background: #cce5ff; color: #004085; }
.action-deleted { background: #f8d7da; color: #721c24; }
.action-approved { background: #d1ecf1; color: #0c5460; }
.action-login { background: #f1f3f4; color: #333; }

.resource-info .resource-type {
    font-weight: 600;
    color: #333;
}

.resource-info .resource-id {
    color: #666;
    font-size: 0.8rem;
}

.notes {
    background: #f8f9fa;
    padding: 0.5rem;
    border-radius: 4px;
    font-size: 0.9rem;
}

.no-data {
    text-align: center;
    padding: 3rem;
    color: #666;
}

.no-data i {
    font-size: 3rem;
    margin-bottom: 1rem;
    display: block;
    opacity: 0.5;
}

.pagination-wrapper {
    margin-top: 2rem;
    display: flex;
    justify-content: center;
}

/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
}

.modal-content {
    background-color: #fff;
    margin: 5% auto;
    padding: 0;
    border-radius: 12px;
    width: 90%;
    max-width: 600px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.2);
}

.modal-header {
    padding: 1.5rem;
    border-bottom: 1px solid #dee2e6;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-header h3 {
    margin: 0;
    color: #2d6a4f;
}

.close-modal {
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    color: #666;
}

.modal-body {
    padding: 1.5rem;
    max-height: 400px;
    overflow-y: auto;
}

.changes-list {
    list-style: none;
    padding: 0;
}

.changes-list li {
    padding: 0.5rem;
    margin-bottom: 0.5rem;
    background: #f8f9fa;
    border-radius: 4px;
    border-left: 4px solid #2d6a4f;
}

.change-field {
    font-weight: 600;
    color: #333;
}

.change-from, .change-to {
    font-size: 0.9rem;
    display: block;
    margin-top: 0.25rem;
}

.change-from::before {
    content: "From: ";
    color: #dc3545;
}

.change-to::before {
    content: "To: ";
    color: #28a745;
}

@media (max-width: 768px) {
    .filters-form .filter-row {
        grid-template-columns: 1fr;
    }

    .data-table {
        font-size: 0.9rem;
    }

    .data-table thead th,
    .data-table tbody td {
        padding: 0.5rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // View changes modal
    const modal = document.getElementById('changesModal');
    const closeBtn = document.querySelector('.close-modal');

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('view-changes')) {
            const changes = JSON.parse(e.target.dataset.changes);
            showChangesModal(changes);
        }
    });

    closeBtn.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    window.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });

    function showChangesModal(changes) {
        const changesContent = document.getElementById('changesContent');
        let html = '<ul class="changes-list">';

        for (const field in changes) {
            html += `
                <li>
                    <div class="change-field">${field}</div>
                    <div class="change-from">${changes[field].from}</div>
                    <div class="change-to">${changes[field].to}</div>
                </li>
            `;
        }

        html += '</ul>';
        changesContent.innerHTML = html;
        modal.style.display = 'block';
    }
});
</script>
@endpush

@endsection
