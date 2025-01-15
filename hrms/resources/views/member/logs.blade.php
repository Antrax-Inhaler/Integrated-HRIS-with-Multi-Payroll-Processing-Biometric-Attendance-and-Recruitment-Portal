@include('member.sidenav');
<section class="home-section" style="width: calc(100% - 58px); overflow: scroll">

<h1>Log Notifications</h1>
    <div class="table table-bordered">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Message</th>
                    <th>Date and Time</th>
                </tr>
            </thead>
            <tbody>
                @forelse($notifications as $index => $notification)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $notification->message }}</td>
                        <td>{{ $notification->created_at->format('M d, Y h:i A') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No log notifications found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>