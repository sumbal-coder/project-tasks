<form id="taskForm" name="taskForm" class="form-horizontal" enctype="multipart/form-data" onsubmit="saveTask(event)">
    @csrf
    <input type="hidden" value="{{isset($task) ? $task->id: ''}}" name="task_id" id="task_id">
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-label" for="title">Title</label>
            <div class="form-control-wrap">
                <input type="text" class="form-control" id="title" name="title" value="{{isset($task) ? $task->title: ''}}" class="required">
            </div>
        </div>
        <div class="form-group">
            <label class="form-label" for="description">Description</label>
            <div class="form-control-wrap">
                <input type="text" class="form-control" id="description" name="description" value="{{isset($task) ? $task->description: ''}}" class="required">
            </div>
        </div>
        <div class="form-group">
            <label class="form-label" for="priority">Priority</label>
            <div class="form-control-wrap ">
                <div class="form-control-select">
                    <select class="form-control" id="priority">
                        <option value="default_option">Select Priority</option>
                        <option value="low">Low</option>
                        <option value="high">High</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Due Date</label>
            <input type="date" class="form-control" id="due_date_picker">
        </div>
    </div>
    <div class="form-group">
        <div class="preview-block">
            <label class="form-label">Completed</label>
            <div class="custom-control custom-switch">
                <label class="custom-control-label" for="customSwitch2">Switch</label>
                <input type="checkbox" class="custom-control-input" id="customSwitch2">
            </div>
        </div>
    </div>

    </div>

    <div class="col-sm-offset-2 col-sm-10 mt-3">
        <button type="submit" class="btn btn-lg btn-primary" id="saveBtn" value="create">Save changes</button>
    </div>
</form>