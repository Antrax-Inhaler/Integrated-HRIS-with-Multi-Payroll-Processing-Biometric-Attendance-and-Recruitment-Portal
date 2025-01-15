@include('admin.sidenav')
<section class="home-section" style="width: calc(100% - 58px); overflow-y: scroll;">

<div class="container mt-5">
    <h2>Job Listings</h2>

    <!-- Button to trigger add job listing modal -->
    <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addJobModal">Add Job Listing</button>
    <br>
    <br>
    <!-- Job Listings Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Job Title</th>
                <th>Department</th>
                <th>Job Type</th>
                <th>Salary Range</th>
                <th>Experience Level</th>
                <th>Education Requirement</th>
                <th>Job Description</th>
                <th>Key Responsibilities</th>
                <th>Application Deadline</th>
                <th>Required Skills</th>
                <th>Posted Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($jobListings as $job)
            <tr>
                <td>{{ $job->id }}</td>
                <td>{{ $job->job_title }}</td>
                <td>{{ $job->department }}</td>
                <td>{{ $job->job_type }}</td>
                <td>{{ $job->salary_range }}</td>
                <td>{{ $job->experience_level }}</td>
                <td>{{ $job->education_requirement }}</td>
                <td>{{ $job->job_description }}</td>
                <td>{{ $job->key_responsibilities }}</td>
                <td>{{ $job->required_skills }}</td>
                <td>{{ $job->application_deadline }}</td>
                <td>{{ $job->posted_date }}</td>
                <td>
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editJobModal{{ $job->id }}">Edit</button>
                    <form action="{{ route('admin.job_list.destroy', $job->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>

            <!-- Edit Job Modal -->
            <div class="modal fade" id="editJobModal{{ $job->id }}" tabindex="-1" role="dialog" aria-labelledby="editJobModalLabel{{ $job->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editJobModalLabel{{ $job->id }}">Edit Job Listing</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.job_list.update', $job->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <!-- Job Title -->
                                <div class="form-group">
                                    <label for="job_title">Job Title</label>
                                    <input type="text" class="form-control" name="job_title" value="{{ $job->job_title }}" required>
                                </div>
            
                                <!-- Department -->
                                <div class="form-group">
                                    <label for="department">Department</label>
                                    <input type="text" class="form-control" name="department" value="{{ $job->department }}" required>
                                </div>
            
                                <!-- Job Type -->
                                <div class="form-group">
                                    <label for="job_type">Job Type</label>
                                    <select name="job_type" class="form-control" required>
                                        <option value="Full-time" {{ $job->job_type == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                        <option value="Part-time" {{ $job->job_type == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                        <option value="Contract" {{ $job->job_type == 'Contract' ? 'selected' : '' }}>Contract</option>
                                    </select>
                                </div>
            
                                <!-- Salary Range -->
                                <div class="form-group">
                                    <label for="salary_range">Salary Range</label>
                                    <input type="text" class="form-control" name="salary_range" value="{{ $job->salary_range }}" required>
                                </div>
            
                                <!-- Experience Level -->
                                <div class="form-group">
                                    <label for="experience_level">Experience Level</label>
                                    <select name="experience_level" class="form-control" required>
                                        <option value="Entry-level" {{ $job->experience_level == 'Entry-level' ? 'selected' : '' }}>Entry-level</option>
                                        <option value="Mid-level" {{ $job->experience_level == 'Mid-level' ? 'selected' : '' }}>Mid-level</option>
                                        <option value="Senior-level" {{ $job->experience_level == 'Senior-level' ? 'selected' : '' }}>Senior-level</option>
                                    </select>
                                </div>
            
                                <!-- Education Requirement -->
                                <div class="form-group">
                                    <label for="education_requirement">Education Requirement</label>
                                    <input type="text" class="form-control" name="education_requirement" value="{{ $job->education_requirement }}" required>
                                </div>
            
                                <!-- Job Description -->
                                <div class="form-group">
                                    <label for="job_description">Job Description</label>
                                    <textarea class="form-control" name="job_description" rows="3" required>{{ $job->job_description }}</textarea>
                                </div>
            
                                <!-- Key Responsibilities -->
                                <div class="form-group">
                                    <label for="key_responsibilities">Key Responsibilities</label>
                                    <textarea class="form-control" name="key_responsibilities" rows="3" required>{{ $job->key_responsibilities }}</textarea>
                                </div>
            
                                <!-- Required Skills -->
                                <div class="form-group">
                                    <label for="required_skills">Required Skills</label>
                                    <textarea class="form-control" name="required_skills" rows="3" required>{{ $job->required_skills }}</textarea>
                                </div>
            
                                <!-- Application Deadline -->
                                <div class="form-group">
                                    <label for="application_deadline">Application Deadline</label>
                                    <input type="date" class="form-control" name="application_deadline" value="{{ $job->application_deadline }}" required>
                                </div>
            
                                <!-- Posted Date -->
                                <div class="form-group">
                                    <label for="posted_date">Posted Date</label>
                                    <input type="date" class="form-control" name="posted_date" value="{{ $job->posted_date }}" required>
                                </div>
            
                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </tbody>
    </table>
</div>

<!-- Add Job Modal -->
<div class="modal fade" id="addJobModal" tabindex="-1" role="dialog" aria-labelledby="addJobModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addJobModalLabel">Add Job Listing</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.job_list.store') }}" method="POST">
                    @csrf
                    
                    <!-- Job Title -->
                    <div class="form-group">
                        <label for="job_title">Job Title</label>
                        <input type="text" class="form-control" name="job_title" placeholder="Job Title" required>
                    </div>
            
                    <!-- Department -->
                    <div class="form-group">
                        <label for="department">Department</label>
                        <input type="text" class="form-control" name="department" placeholder="Department" required>
                    </div>
            
                    <!-- Job Type -->
                    <div class="form-group">
                        <label for="job_type">Job Type</label>
                        <select name="job_type" class="form-control" required>
                            <option value="Full-time">Full-time</option>
                            <option value="Part-time">Part-time</option>
                            <option value="Contract">Contract</option>
                        </select>
                    </div>
            
                    <!-- Salary Range -->
                    <div class="form-group">
                        <label for="salary_range">Salary Range</label>
                        <input type="text" class="form-control" name="salary_range" placeholder="Salary Range" required>
                    </div>
            
                    <!-- Experience Level -->
                    <div class="form-group">
                        <label for="experience_level">Experience Level</label>
                        <select name="experience_level" class="form-control" required>
                            <option value="Entry-level">Entry-level</option>
                            <option value="Mid-level">Mid-level</option>
                            <option value="Senior-level">Senior-level</option>
                        </select>
                    </div>
            
                    <!-- Education Requirement -->
                    <div class="form-group">
                        <label for="education_requirement">Education Requirement</label>
                        <input type="text" class="form-control" name="education_requirement" placeholder="Education Requirement" required>
                    </div>
            
                    <!-- Job Description -->
                    <div class="form-group">
                        <label for="job_description">Job Description</label>
                        <textarea class="form-control" name="job_description" rows="3" placeholder="Job Description" required></textarea>
                    </div>
            
                    <!-- Key Responsibilities -->
                    <div class="form-group">
                        <label for="key_responsibilities">Key Responsibilities</label>
                        <textarea class="form-control" name="key_responsibilities" rows="3" placeholder="Key Responsibilities" required></textarea>
                    </div>
            
                    <!-- Required Skills -->
                    <div class="form-group">
                        <label for="required_skills">Required Skills</label>
                        <textarea class="form-control" name="required_skills" rows="3" placeholder="Required Skills" required></textarea>
                    </div>
            
                    <!-- Application Deadline -->
                    <div class="form-group">
                        <label for="application_deadline">Application Deadline</label>
                        <input type="date" class="form-control" name="application_deadline" required>
                    </div>
            
                    <!-- Posted Date -->
                    <div class="form-group">
                        <label for="posted_date">Posted Date</label>
                        <input type="date" class="form-control" name="posted_date" required>
                    </div>
            
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-success">Add Job Listing</button>
                </form>
            </div>
            
        </div>
    </div>
</div>

</section>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
