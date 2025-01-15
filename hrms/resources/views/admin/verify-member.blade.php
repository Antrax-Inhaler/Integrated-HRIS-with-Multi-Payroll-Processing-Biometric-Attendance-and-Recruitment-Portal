@include('admin.sidenav')

<section class="home-section" style="width: calc(100% - 58px); overflow:scroll">

<div class="container mt-5">
    <h2>Member Verification</h2>

    <!-- Members Pending Verification Table -->
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Surname</th>
            <th>Given Name</th>
            <th>Email</th>
            <th>Contact Number</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($pendingMembers as $member)
            <tr>
                <td>{{ $member->id }}</td>
                <td>{{ $member->surname }}</td>
                <td>{{ $member->given_name }}</td>
                <td>{{ $member->email }}</td>
                <td>{{ $member->contact_number }}</td>
                <td>
                    <a href="{{ route('admin.verify-member.view', $member->id) }}" class="btn btn-info btn-sm">View</a>
                    <form action="{{ route('admin.verify-member.verify', $member->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success btn-sm">Verify</button>
                    </form>
                    <form action="{{ route('admin.verify-member.reject', $member->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

</section>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
