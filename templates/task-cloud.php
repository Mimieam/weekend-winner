        <div class="navbar navbar-fixed-bottom navbar-inverse" id="bottom-navbar">
            <div class="navbar-inner">
                <form class="navbar-search pull-right" onsubmit="alert('Just a demo.');return false">
                    <input type="text" class="search-query" placeholder="Search">
                </form>
                <ul class="pager" style="margin:4px 0 0;padding:0" id="bottom-tasks">
                    <li id="create-task"><a href="#" data-toggle="modal" data-target="#newTask">Create Task</a></li>
                    <li id="create-assoc-task" class="disabled"><a href="#" data-toggle="modal" data-target="#newAssocTask">Create Associated Task</a></li>
                    <li id="create-assoc" class="disabled"><a href="#" data-toggle="modal" data-target="#newAssoc">Create Association</a></li>
                </ul>
            </div>
        </div>
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
    <div id="newTask" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 style="margin:0 0 -15px;padding:0">New Task</h3>
      </div>
      <form method="post" action="/" id="new-task-form" class="form-horizontal" enctype="multipart/form-data">
        <fieldset>
          <div class="modal-body">
            <input type="hidden" name="cmd" value="new-task" id="task-cmd"/>
            <input type="text" name="task-text" placeholder="Your task information…" style="width:95%"/>
            <div style="padding:5px 0">
              <a href="#" onclick="$(this).toggle();$('#modal-body-extended').toggle();return false;"><i class="icon-chevron-down"></i>More Options</a>
            </div>
            <div id="modal-body-extended" style="display:none">
              <div class="control-group">
                <label class="control-label" for="taskColor">Importance</label>
                <div class="controls">
                  <select name="task-color" id="taskColor" onchange="$(this).css('background-color', '#'+$(this).val())" style="background-color:#d66279">
                    <option value="ff3300" style="background-color:#ff3300">High</option>
                    <option value="d66279" style="background-color:#d66279" selected="selected">Normal</option>
                    <option value="ac90f2" style="background-color:#ac90f2">Low</option>
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="taskAttachment">Attachment</label>
                <div class="controls">
                  <input type="file" id="taskAttachment" name="task-attachment">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="taskTags">Tags</label>
                <div class="controls">
                  <input type="text" id="taskTags" name="task-tags">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="taskDate">Date</label>
                <div class="controls">
                  <input type="text" id="taskDate" name="task-date" class="datepicker">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="taskReminder">Reminder</label>
                <div class="controls">
                  <input type="text" id="taskReminder" name="task-reminder" class="datepicker">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn" data-dismiss="modal" aria-hidden="true" onclick="$('#newTask').modal('hide')">Cancel</button>
              <button class="btn btn-primary">Create</button>
          </div>
        </fieldset>
      </form>
    </div>
    <script id="taskTemplate" type="text/template">
    <div class="task-container" id="task-{{id}}" data-unique="{{id}}">
      <p>{{content}}</p>
      {{#eventDate}}{{eventDate}}{{/eventDate}}
      <div class="attachments"></div>
    </div>
    </script>
    <script id="attachmentTemplate" type="text/template">
        {{#isImage}}
            <a onclick="curLightbox = $('#lightbox-{{id}}').lightbox();return false" href="#">{{name}}</a>
        {{/isImage}}
        {{#isNotImage}}
          <p><a href="{{url}}">{{name}}</a></p>
        {{/isNotImage}}
    </script>
    <script id="attachmentTemplateLightbox" type="text/template">
        <div class="lightbox fade" id="lightbox-{{id}}" style="display: none;">
            <div class='lightbox-content'>
                <img src="{{url}}">
            </div>
        </div>
    </script>
    <script>
        var curLightbox = false;
        var highestZ = 1;
        $(document).ready(function(){
            $('.datepicker').datepicker();
            $('#bottom-tasks a').noisy({
                'intensity' : 1,
                'size' : 200,
                'opacity' : 0.08,
                'fallback' : '',
                'monochrome' : false
            }).css('background-color', '#070903');
            $('.dropdown-toggle').dropdown();
        });
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
        var knownTasks = <?php echo json_encode($tasks); ?>;
        $.each(knownTasks, function(i, data){
          var html = $(Mustache.to_html($('#taskTemplate').html(), data));
          var attachmentHTML = $('<div>');
          $.each(data.attachments, function(i, attachment){
            attachmentHTML.append(Mustache.to_html($('#attachmentTemplate').html(), attachment));
            //Lives outside the other div since it mucks up the z-index
            if (attachment.isImage) {
                $('.container').append(Mustache.to_html($('#attachmentTemplateLightbox').html(), attachment));
            }
          });
          $('div.attachments', html).html(attachmentHTML.html());
          $('.container').append(html);
          $('#task-'+data.id).css({
            'border-color': '#'+data.color,
            top: data.top+'px',
            left: data.left+'px'
          });
          bindCustomParts($('#task-'+data.id));
        });
        function bindCustomParts(domPiece) {
          $(domPiece).draggable({
            start: function(event, ui) {
                $(this).css('z-index', highestZ++);
                $(this).addClass('dragging');
            },
            stop: function(event, ui) {
              $(this).removeClass('dragging');
              $.ajax({
                type: 'post',
                url: '/ajax/cmd.php',
                data: {
                  cmd: 'move-task',
                  top: ui.position.top,
                  left: ui.position.left,
                  id: $(this).data('unique'),
                }
              });
            }
          });
          $(domPiece).on("click", function(event){
            event.stopPropagation();
            if (!$(this).data('active')) {
              $(this).css('z-index', highestZ++);
              unselectEverythingBut($(this).data('unique'));
              $(this).addClass('active').data('active', true);
              $('#create-assoc-task, #create-assoc').removeClass('disabled');
            } else {
              $(this).removeClass('active').data('active', false);
              $('#create-assoc-task, #create-assoc').addClass('disabled');
            }
          });
        }
        $('body').on('click', function(event){
          unselectEverythingBut();
        });
        function unselectEverythingBut(taskId) {
          $('.task-container').each(function(){
            if ($(this).data('active') && $(this).data('unique') != taskId) {
              $(this).trigger('click');
            }
          });          
        }
    </script>