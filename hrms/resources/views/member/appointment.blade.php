@include('user.sidenav');
<section class="home-section" style="width: calc(100% - 58px);overflow:scroll">
        <div class="home-content" style="display:block;font-color:">
        <div class="panel">
            <h1  style=" text-align: left;">Appointment</h1><br>
            <hr><br>
            <div class="box" style="background:transparent;">
            <button class="button" id="openModalBtn">
            <span class="button-content">Make an Appointment</span>
            </button>
            </div><br>

            <div id="appointmentModal" class="modal">
        <div class="modal-content">
            <span class="closeBtn">&times;</span>
            <h1>Appointment Form</h1> <br>
            <form id="appointmentForm"> 
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required><br><br>
                <label for="time">Time:</label>
                <input type="time" id="time" name="time" required><br><br>

                <div class="box" style="text-align:center;">
                <button class="button">
                <span class="button-content">Submit</span>
                </button>
                </div>

                </div>

            </form>
        </div>
    </div>

        </div>
        </div>
      </section>
        <script
        src="https://www.chatbase.co/embed.min.js"
        chatbotId="XJrq5XGGemsfY5X_30vHq"
        domain="www.chatbase.co"
        defer>
        </script>
      <script src="/js/scripts.js"></script>
      <script src="/js/modal.js"></script>
</body>