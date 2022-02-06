<form class="form" action="" method="post">
    @csrf
    <div class="form-group">
        <label for="">Session Name</label>
        <input type="text" class="form-control" name="name" required>
    </div>
    <div class="form-group">
        <label for="">Session Duration</label>
        <input type="text" class="form-control" name="duration" required>
    </div>
    <div class="form-group">
        <label for="">Session Start at</label>
        <input type="datetime-local" class="form-control " required name="start_at" value="Select Date">
    </div>


    <div class="form-groups">
        <label for="">Session Description</label>
        <textarea class="form-control" id="summernote" name="description"></textarea>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-success ">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</form>
<script>
    $('.date-picker-default').datepicker()
</script>
