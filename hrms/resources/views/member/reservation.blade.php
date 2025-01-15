@include('user.sidenav')
<section class="home-section" style="width: calc(100% - 58px); overflow: auto;">
    <div class="home-content" style="display: block;">
        <div class="panel">
            <h1 style="text-align: left;">Reservation</h1><br>
            <hr><br>

            <div class="box" style="background: transparent;">
                <button class="button" id="openModalBtn">
                    <span class="button-content">Make Reservation</span>
                </button>
            </div><br>

            <div id="appointmentModal" class="modal">
                <div class="modal-content">
                    <span class="closeBtn">&times;</span>
                    <h1>Reservation Form</h1> <br>
                    <form id="appointmentForm">
                      <!-- Multi-select Dropdown with Checkboxes -->
                      <div class="dropdown">
                            <button type="button" class="dropdown-btn">Facilities</button>
                            <div class="dropdown-content">
                                <label><input type="checkbox" value="Chapel" data-type="facility" style="width:20px">Chapel</label>
                                <label><input type="checkbox" value="Tents" data-type="facility" style="width:20px">Tents</label>
                                <label><input type="checkbox" value="Gathering Halls" data-type="facility" style="width:20px">Gathering Halls</label>
                            </div>
                        </div>
                        <div class="selected-items">
                            <h4>Selected Facilities:</h4>
                            <ul id="selectedFacilitiesList"></ul>
                        </div> <br>

                        <div class="dropdown">
                            <button type="button" class="dropdown-btn">Services</button>
                            <div class="dropdown-content">
                                <label><input type="checkbox" value="Ceremony Services" data-type="service" style="width:20px">Ceremony Services</label>
                                <label><input type="checkbox" value="Floral Arrangement" data-type="service" style="width:20px">Floral Arrangement</label>
                                <label><input type="checkbox" value="Grave Digging Services" data-type="service" style="width:20px">Grave Digging Services</label>
                                <label><input type="checkbox" value="Memorial Consultation" data-type="service" style="width:20px">Memorial Consultations</label>
                            </div>
                        </div>

                        <div class="selected-items">
                            <h4>Selected Services:</h4>
                            <ul id="selectedServicesList"></ul>
                        </div> <br>

                        <label for="date">Date:</label>
                        <input type="date" id="date" name="date" required><br><br>
                        <label for="time">Time:</label>
                        <input type="time" id="time" name="time" required><br><br>

                        <div class="box" style="text-align: center;">
                            <button class="button">
                                <span class="button-content">Submit</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Function to toggle dropdown content
    function toggleDropdownContent(event) {
        event.stopPropagation(); // Prevent closing other dropdowns
        var dropdownContent = event.currentTarget.nextElementSibling;
        dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
    }

    // Function to close all dropdown contents
    function closeAllDropdowns() {
        var dropdowns = document.getElementsByClassName('dropdown-content');
        for (var i = 0; i < dropdowns.length; i++) {
            dropdowns[i].style.display = 'none';
        }
    }

    // Attach event listeners to all dropdown buttons
    var dropdownButtons = document.querySelectorAll('.dropdown-btn');
    dropdownButtons.forEach(function(button) {
        button.addEventListener('click', toggleDropdownContent);
    });

    // Close dropdowns when clicking outside
    window.addEventListener('click', function(event) {
        if (!event.target.matches('.dropdown-btn')) {
            closeAllDropdowns();
        }
    });

    // Update selected items list when checkboxes are changed
    document.querySelectorAll('.dropdown-content input[type="checkbox"]').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            var selectedFacilitiesList = document.getElementById('selectedFacilitiesList');
            var selectedServicesList = document.getElementById('selectedServicesList');

            selectedFacilitiesList.innerHTML = '';
            selectedServicesList.innerHTML = '';

            document.querySelectorAll('.dropdown-content input[type="checkbox"]:checked').forEach(function(checkedCheckbox) {
                var li = document.createElement('li');
                li.textContent = checkedCheckbox.value;

                if (checkedCheckbox.dataset.type === 'facility') {
                    selectedFacilitiesList.appendChild(li);
                } else if (checkedCheckbox.dataset.type === 'service') {
                    selectedServicesList.appendChild(li);
                }
            });
        });
    });
</script>
<style>
    .dropdown {
        position: relative;
        display: block;
        width: 100%;
    }

    .dropdown-content {
        display: none;
        position: relative;
        background-color: #f9f9f9;
        min-width: 100%;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    .dropdown-content label {
        display: flex;
        padding: 10px;
        width: 100%;
    }

    .dropdown-content label:hover {
        background-color: #f1f1f1;
    }

    .dropdown-content input {
        margin-right: 10px;
    }

    .dropdown-btn {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 10px;
        border: none;
        cursor: pointer;
        box-sizing: border-box;
    }

    .dropdown-btn:hover {
        background-color: #45a049;
    }

    .selected-items ul {
        list-style-type: none;
        padding: 0;
    }

    .selected-items li {
        background-color: #e1e1e1;
        margin: 5px 0;
        padding: 5px;
    }
</style>
<script src="https://www.chatbase.co/embed.min.js" chatbotId="XJrq5XGGemsfY5X_30vHq" domain="www.chatbase.co" defer></script>
<script src="/js/scripts.js"></script>
<script src="/js/modal.js"></script>
