        <div class="navbar navbar-fixed-bottom navbar-inverse">
            <div class="navbar-inner">
                <form class="navbar-search pull-right" onsubmit="alert('Just a demo.');return false">
                    <input type="text" class="search-query" placeholder="Search">
                </form>
                <ul class="pager" style="margin:4px 0 0;padding:0">
                    <li><a href="#">Create Task</a></li>
                    <li class="disabled"><a href="#">Create Associated Task</a></li>
                    <li class="disabled"><a href="#">Create Association</a></li>
                </ul>
            </div>
        </div>
    </div> <!-- /container -->
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <?php
    include dirname(__FILE__).'/persona-handler.inc.php';
    ?>
    <!-- Modal -->
    <div id="newTopic" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 style="margin:0 0 -15px;padding:0">Create New Topic</h3>
      </div>
      <form method="post" action="/">
        <fieldset>
          <div class="modal-body">
            <input type="hidden" name="cmd" value="create-topic"/>
            <label>Topic name</label>
            <input type="text" name="topic-name" placeholder="Type something…">
          </div>
          <div class="modal-footer">
              <button type="button" class="btn" data-dismiss="modal" aria-hidden="true" onclick="$('#newTopic').modal('hide')">Cancel</button>
              <button class="btn btn-primary">Create</button>
          </div>
        </fieldset>
      </form>
    </div>
    <div id="changeTopic" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 style="margin:0 0 -15px;padding:0">Update Topic</h3>
      </div>
      <form method="post" action="/" id="topic-form">
        <fieldset>
          <div class="modal-body">
            <input type="hidden" id="topic-id" name="topic-id" value="<?php echo $topic->getId(); ?>"/>
            <input type="hidden" name="cmd" value="update-topic" id="topic-cmd"/>
            <label>Topic name</label>
            <input type="text" name="topic-name" value="<?php echo htmlspecialchars($topic->getName()); ?>"/>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-danger pull-left" id="delete-topic">Delete</button>
              <button type="button" class="btn" data-dismiss="modal" aria-hidden="true" onclick="$('#newTopic').modal('hide')">Cancel</button>
              <button class="btn btn-primary">Update</button>
          </div>
        </fieldset>
      </form>
    </div>
    <script>
        $('.dropdown-toggle').dropdown();
        <?php
        if (isset($_SESSION['message'])) {
            echo 'alert('.json_encode($_SESSION['message']).');';
        }
        ?>
        $('#delete-topic').click(function() {
            if (confirm('Are you sure?')) {
                $('#topic-cmd').val('delete-topic');
                $('#topic-form').submit();
            } else {
                return false;
            }
        });
        $('#newTopic').on('shown', function () {
            $('#newTopic input[type="text"]').focus();
        });
        $('#changeTopic').on('shown', function () {
            $('#changeTopic input[type="text"]').focus();
        });
        </script>
  </body>
</html>
