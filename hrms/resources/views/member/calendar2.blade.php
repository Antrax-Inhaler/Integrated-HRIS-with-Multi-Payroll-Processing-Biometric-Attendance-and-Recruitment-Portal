<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href='calendar/css/libs/bootstrap.min.css' rel='stylesheet' />
    <link href='calendar/css/libs/fullcalendar.css' rel='stylesheet' />
    <link href='calendar/css/calendar.css' rel='stylesheet' />

    <script src='calendar/js/libs/jquery.min.js'></script>
    <script src='calendar/js/libs/moment.min.js'></script>
    <script src='calendar/js/libs/moment.min.js'></script>
    <script src='calendar/js/libs/bootstrap.min.js'></script>
    <script src='calendar/js/libs/fullcalendar.js'></script>
    <script src='calendar/js/events.js'></script>
    <script src='calendar/js/calendar.js'></script>
    <link rel="icon" href="/img/logo2.svg" type="icon">

    <!--[if lt IE 8]>
        <link href="/css/vendor/bootstrap-ie7.css" rel="stylesheet">
    <![endif]-->

    <title>User Dashboard</title>
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
        <a href="/user">
        <button class="button">
            <span class="button-content">< Back</span>
        </button>
        </a>
        <img src="/img/logo2.svg" alt="">
        <span class="logo_name">EGPARK</span>
        </div>
    </nav>

    <div class="container-fluid row">
        <div id='calendar1' class='calendar col-md-8'></div>
        <div id='calendar2' class='calendar col-md-4'></div>
    </div>

    <div class="modal fade" id="newEvent" role="dialog" aria-labelledby="eventFormLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="newEvent">New Apppointment</h4>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title" class="form-control-label">Title</label>
                            <input type="text" class="form-control" id="title">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" id="submit">Create Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editEvent" role="dialog" aria-labelledby="eventFormLabel" aria-hidden="true" data-persist="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
                    <h4 class="modal-title" id="editEvent">Update Apppointment</h4>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title" class="form-control-label">Title</label>
                            <input type="text" class="form-control" id="editTitle">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger left" id="delete">Delete Event</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" id="update">Update Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script
        src="https://www.chatbase.co/embed.min.js"
        chatbotId="XJrq5XGGemsfY5X_30vHq"
        domain="www.chatbase.co"
        defer>
        </script>
</body>

</html>
