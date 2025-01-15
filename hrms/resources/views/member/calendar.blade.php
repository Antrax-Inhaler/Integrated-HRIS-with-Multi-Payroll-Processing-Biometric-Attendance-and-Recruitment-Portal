@include('user.sidenav');
<section class="home-section" style="width: calc(100% - 58px);overflow:scroll">
        <div class="home-content" style="display:block;font-color:">
        <div class="panel">
            <h1  style=" text-align: left;">Calendar</h1><br>
            <hr><br>
    	
        <div class="panel2">
        <div class="half" style="background-color: #11101d;border-radius: 25px;">
            <!-- start -->
        <div class="calendar">
        <div class="month">
            <button id="prev" onclick="moveDate('prev')">❮</button>
            <div class="date">
                <h1 id="month"></h1>
                <p id="year"></p>
            </div>
            <button id="next" onclick="moveDate('next')">❯</button>
        </div>
        <div class="weekdays">
            <div>Sun</div>
            <div>Mon</div>
            <div>Tue</div>
            <div>Wed</div>
            <div>Thu</div>
            <div>Fri</div>
            <div>Sat</div>
        </div>
        <div class="days"></div>
    </div>
    <!-- end -->
        </div>


        <div class="half">

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
      <script src="/js/calendar.js"></script>
</body>