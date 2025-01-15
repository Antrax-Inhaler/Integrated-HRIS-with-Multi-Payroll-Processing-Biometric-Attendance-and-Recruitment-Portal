@extends('admin.sidenav')

<section class="home-section" style="width: calc(100% - 58px); overflow:scroll">

<style>
    h2 {
        color: #2F4F4F; /* Dark greenish color */
        margin-bottom: 20px;
    }

    .form-group label {
        font-weight: bold;
        color: #2F4F4F; /* Dark greenish color */
    }

    .form-control {
        border-radius: 4px;
        border: 1px solid #ccc;
        padding: 10px;
    }

    .btn-primary {
        background-color: #007BFF;
        border-color: #007BFF;
        color: white;
        margin-top: 20px;
    }

    table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid #ddd;
    }

    th, td {
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
        color: #2F4F4F;
    }

    .recommendation-list {
        list-style: none;
        padding: 0;
        margin: 0;
        border: 1px solid #ccc;
        border-radius: 4px;
        max-height: 100px;
        overflow-y: auto;
        display: none;
        position: absolute;
        z-index: 1;
        background-color: white;
    }

    .recommendation-list li {
        padding: 8px;
        cursor: pointer;
    }

    .recommendation-list li:hover {
        background-color: #f2f2f2;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1050;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        outline: 0;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        position: relative;
        margin: auto;
        top: 20%;
        width: 50%;
        padding: 20px;
        background-color: white;
        border-radius: 5px;
    }

    .close {
        position: absolute;
        right: 10px;
        top: 10px;
        font-size: 24px;
        cursor: pointer;
    }
</style>

<div class="container mt-5">
    <h2>Issue Bonus</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('bonus.store') }}" method="POST">
        @csrf

        <!-- Employee -->
        <div class="form-group">
            <label for="member_id">Employee</label>
            <select class="form-control" id="member_id" name="member_id" required>
                @foreach($members as $member)
                    <option value="{{ $member->id }}">{{ $member->surname }}, {{ $member->given_name }} {{ $member->middle_name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Bonus Name -->
        <div class="form-group position-relative">
            <label for="bonus_name">Bonus Name</label>
            <input type="text" class="form-control" id="bonus_name" name="bonus_name" required autocomplete="off">
            <ul id="bonus_recommendations" class="recommendation-list"></ul>
        </div>

        <!-- Description -->
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>

        <!-- Amount -->
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" class="form-control" id="amount" name="amount" required>
        </div>

        <!-- Effective Date -->
        <div class="form-group">
            <label for="effective_date">Effective Date</label>
            <input type="date" class="form-control" id="effective_date" name="effective_date" required>
        </div>

        <button type="submit" class="btn btn-primary">Issue Bonus</button>
    </form>

    <!-- Upcoming Bonuses Table -->
    <h2>Upcoming Bonuses</h2>
    <table>
        <thead>
            <tr>
                <th>Bonus Name</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Effective Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($upcomingBonuses as $bonus)
                <tr>
                    <td>{{ $bonus->bonus_name }}</td>
                    <td>{{ $bonus->description }}</td>
                    <td>{{ $bonus->amount }}</td>
                    <td>{{ $bonus->effective_date }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm edit-btn" data-id="{{ $bonus->id }}">Edit</button>
                        <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $bonus->id }}">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Past Bonuses Table -->
    <h2>Past Bonuses</h2>
    <table>
        <thead>
            <tr>
                <th>Bonus Name</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Effective Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pastBonuses as $bonus)
                <tr>
                    <td>{{ $bonus->bonus_name }}</td>
                    <td>{{ $bonus->description }}</td>
                    <td>{{ $bonus->amount }}</td>
                    <td>{{ $bonus->effective_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Edit Bonus</h2>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <!-- Employee -->
            <div class="form-group">
                <label for="edit_member_id">Employee</label>
                <select class="form-control" id="edit_member_id" name="member_id" required>
                    @foreach($members as $member)
                                                <option value="{{ $member->id }}">{{ $member->surname }}, {{ $member->given_name }} {{ $member->middle_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Bonus Name -->
            <div class="form-group">
                <label for="edit_bonus_name">Bonus Name</label>
                <input type="text" class="form-control" id="edit_bonus_name" name="bonus_name" required>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="edit_description">Description</label>
                <textarea class="form-control" id="edit_description" name="description"></textarea>
            </div>

            <!-- Amount -->
            <div class="form-group">
                <label for="edit_amount">Amount</label>
                <input type="number" class="form-control" id="edit_amount" name="amount" required>
            </div>

            <!-- Effective Date -->
            <div class="form-group">
                <label for="edit_effective_date">Effective Date</label>
                <input type="date" class="form-control" id="edit_effective_date" name="effective_date" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Bonus</button>
        </form>
    </div>
</div>

<!-- Delete Modal -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Confirm Deletion</h2>
        <p>Are you sure you want to delete this bonus?</p>
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
            <button type="button" class="btn btn-secondary close">Cancel</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.edit-btn');
        const deleteButtons = document.querySelectorAll('.delete-btn');
        const editModal = document.getElementById('editModal');
        const deleteModal = document.getElementById('deleteModal');
        const editForm = document.getElementById('editForm');
        const deleteForm = document.getElementById('deleteForm');
        const closeButtons = document.querySelectorAll('.close');

        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                fetch(`/admin/issue-bonus/${id}/edit`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('edit_member_id').value = data.bonus.member_id;
                        document.getElementById('edit_bonus_name').value = data.bonus.bonus_name;
                        document.getElementById('edit_description').value = data.bonus.description;
                        document.getElementById('edit_amount').value = data.bonus.amount;
                        document.getElementById('edit_effective_date').value = data.bonus.effective_date;
                        editForm.action = `/admin/issue-bonus/${id}`;
                        editModal.style.display = 'block';
                    });
            });
        });

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                deleteForm.action = `/admin/issue-bonus/${id}`;
                deleteModal.style.display = 'block';
            });
        });

        closeButtons.forEach(button => {
            button.addEventListener('click', function () {
                editModal.style.display = 'none';
                deleteModal.style.display = 'none';
            });
        });

        window.onclick = function (event) {
            if (event.target == editModal || event.target == deleteModal) {
                editModal.style.display = 'none';
                deleteModal.style.display = 'none';
            }
        };
    });
</script>

</section>

