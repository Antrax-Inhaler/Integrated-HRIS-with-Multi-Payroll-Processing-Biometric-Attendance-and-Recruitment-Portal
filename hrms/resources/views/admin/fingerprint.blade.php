<!-- resources/views/admin/fingerprint.blade.php -->
@extends('admin.sidenav')

<section class="home-section" style="width: calc(100% - 58px); overflow:scroll">
    <form action="{{ route('admin.fingerprint.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="file">Select Excel File</label>
            <input type="file" name="file" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Import Attendance</button>
    </form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Display extracted attendance data -->
    @if(!empty($attendanceData))
        <h3>Imported Attendance Data</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Member ID</th>
                    <th>Date</th>
                    <th>AM IN</th>
                    <th>AM OUT</th>
                    <th>PM IN</th>
                    <th>PM OUT</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendanceData as $data)
                    <tr>
                        <td>{{ $data['member_id'] }}</td>
                        <td>{{ $data['date'] }}</td>
                        <td>{{ $data['AM IN'] }}</td>
                        <td>{{ $data['AM OUT'] }}</td>
                        <td>{{ $data['PM IN'] }}</td>
                        <td>{{ $data['PM OUT'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if (is_array($errors) && count($errors) > 0)
    <div class="alert error-alert">
        @foreach ($errors as $error)
            {{ $error }}
        @endforeach
    </div>
@elseif ($errors->any())
    <div class="alert error-alert">
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    </div>
@endif

</section>
