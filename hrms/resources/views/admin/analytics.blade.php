@include('admin.sidenav');
<section class="home-section" style="width: calc(100% - 58px); overflow: scroll">
  <div class="home-content" style="display:block; font-color:">
    <div class="panel">
      <h1 style="text-align: left;">Analytics</h1><br>
      <hr><br>
    </div>
    <!-- start -->
    <h2 class="chart-heading">Greenpark Population</h2>
    <div class="panel2">
      <div class="half">
        <div class="programming-stats">
          <div class="chart-container">
            <canvas class="my-chart"></canvas>
          </div>
          <div class="details">
            <ul></ul>
          </div>
        </div>
      </div>
      <div class="half">
        <canvas class="bar-chart"></canvas>
      </div>
    </div>
    <!-- end -->
  </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="/js/main.js"></script>
