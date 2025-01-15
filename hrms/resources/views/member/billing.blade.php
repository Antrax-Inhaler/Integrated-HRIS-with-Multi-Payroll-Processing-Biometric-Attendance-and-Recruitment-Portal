@include('user.sidenav');
<section class="home-section" style="width: calc(100% - 58px);overflow:scroll">
        <div class="home-content" style="display:block;font-color:">
        <div class="panel">
            <h1  style=" text-align: left;">Billing</h1><br>
            <hr><br>

            <!-- start -->
            <div class="tab">
  <button class="tablinks" onclick="openCity(event, 'Upcoming')">Upcoming</button>
  <button class="tablinks" onclick="openCity(event, 'Pastdue')">Past Due</button>
  <button class="tablinks" onclick="openCity(event, 'Completed')">Completed</button>
</div>

<!-- Tab content -->
<div id="Upcoming" class="tabcontent">
  <p>All Upcoming payments will be displayed here.</p>
</div>

<div id="Pastdue" class="tabcontent">
  <p>All Pastdue payments will be displayed here.</p>
</div>

<div id="Completed" class="tabcontent">
  <p>All completed payments will be displayed here.</p>
</div>
             <!-- end -->
        </div>
        </div>
        </div>

        <script>
            function openCity(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
        </script>

      </section>
        <script
        src="https://www.chatbase.co/embed.min.js"
        chatbotId="XJrq5XGGemsfY5X_30vHq"
        domain="www.chatbase.co"
        defer>
        </script>
      <script src="/js/scripts.js"></script>
</body>