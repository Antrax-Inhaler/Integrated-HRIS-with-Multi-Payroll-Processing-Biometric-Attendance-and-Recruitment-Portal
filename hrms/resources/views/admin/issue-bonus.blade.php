@extends('admin.sidenav')

<section class="home-section" style="width: calc(100% - 58px); overflow:scroll">

<style>
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

    <!-- Bonus List -->
    <h2>Existing Bonuses</h2>
    <table>
        <thead>
            <tr>
                <th>Bonus Name</th>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bonuses as $bonus)
                <tr>
                    <td>{{ $bonus->bonus_name }}</td>
                    <td>{{ $bonus->description }}</td>
                    <td>{{ $bonus->amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    document.getElementById('bonus_name').addEventListener('input', function() {
        const query = this.value.toLowerCase();
        const recommendations = @json($bonuses->pluck('bonus_name')->unique());
        const recommendationList = document.getElementById('bonus_recommendations');

        recommendationList.innerHTML = '';
        if (query) {
            const filteredRecommendations = recommendations.filter(bonus => bonus.toLowerCase().includes(query));
            if (filteredRecommendations.length) {
                filteredRecommendations.forEach(bonus => {
                    const listItem = document.createElement('li');
                    listItem.textContent = bonus;
                    listItem.addEventListener('click', function() {
                        document.getElementById('bonus_name').value = this.textContent;
                        recommendationList.style.display = 'none';
                    });
                    recommendationList.appendChild(listItem);
                });
                recommendationList.style.display = 'block';
            } else {
                recommendationList.style.display = 'none';
            }
        } else {
            recommendationList.style.display = 'none';
        }
    });

    document.addEventListener('click', function(event) {
        if (!event.target.closest('#bonus_name')) {
            document.getElementById('bonus_recommendations').style.display = 'none';
        }
    });
</script>

</section>
