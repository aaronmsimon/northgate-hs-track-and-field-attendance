<style>
    .accordion {
        --bs-accordion-btn-color: white;
        --bs-accordion-btn-bg: #73111d;
        --bs-accordion-btn-icon: #fff;
        --bs-accordion-btn-active-icon: #fff;
        --bs-accordion-btn-focus-box-shadow: none;
        --bs-accordion-active-color: black;
        --bs-accordion-active-bg: #ffc107;
    }
    .accordion-button:not(.collapsed) {
        box-shadow: none;
    }
</style>
<script>
$(document).ready(function(){
    // Attendance
    $("#view-attendance").click(function(){
       // CSRF Hash
       var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
       var csrfHash = $('.txt_csrfname').val(); // CSRF hash
       var querydate = $('#attendancedate').val();

        $.ajax({
            url: "<?= base_url('coaches/attendance-by-day') ?>",
            method: 'post',
            data: {attendancedate: querydate,[csrfName]:csrfHash},
            dataType: 'json',
            success: function(response){
                $("#attendance-list tr").remove();
                $("#attendance-list").append(response.tabledata.html);

                // Update CSRF hash
                $('.txt_csrfname').val(response.token);

                // Display total
                $("#total-attendance").removeClass("d-none").html("Total Attendance: " + Object.keys(response.tabledata.table).length);
            }
        });
    });

    // Roster
    function updateRoster() {
        // CSRF Hash
        var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
        var csrfHash = $('.txt_csrfname').val(); // CSRF hash
        var gender = $('#gender').val();
        var grade = $('#grade').val();
    
         $.ajax({
             url: "<?= base_url('coaches/roster') ?>",
             method: 'post',
             data: {gender: gender,grade: grade,[csrfName]:csrfHash},
             dataType: 'json',
             success: function(response){
                 $("#athlete-list tr").remove();
                 $("#athlete-list").append(response.tabledata.html);
    
                 // Update CSRF hash
                 $('.txt_csrfname').val(response.token);
    
                 // Display total
                 $("#athlete-count").html(Object.keys(response.tabledata.table).length);
             }
         });
    }
    $("#gender").change(function(){
        updateRoster();
    });
    $("#grade").change(function(){
        updateRoster();
    });
    
    updateRoster();
});
</script>

<input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />

<div class="accordion accordion-flush mt-3" id="accordionFlushExample">
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                View Attendance by Day
            </button>
        </h2>
        <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <label for="attendancedate">Date</label>
                <input type="date" id="attendancedate" name="attendancedate" value="<?php date_default_timezone_set('America/Los_Angeles');echo date('Y-m-d'); ?>">
                <button type="submit" class="btn btn-dark" id="view-attendance">View Attendance</button>
                <span class="ms-3 d-none" id="total-attendance"></span>
                <div class="d-flex flex-row mt-3 justify-content-center overflow-scroll" style="max-height: 250px;">
                    <table>
                        <thead><tr><th>Athlete</th></tr></thead>
                        <tbody id="attendance-list"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                Team Roster
            </button>
        </h2>
        <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <div class="row">
                    <select class="form-select w-auto me-3" id="gender">
                        <option value="0" selected>All Genders</option>
                        <?php foreach ($genders as $gender): ?>
                            <option value="<?= esc($gender['id']) ?>"><?= esc($gender['team']) ?></option>
                        <?php endforeach ?>
                    </select>
                    <select class="form-select w-auto" id="grade">
                        <option value="0" selected>All Grades</option>
                        <?php foreach ($gradelevels as $gradelevel): ?>
                            <option value="<?= esc($gradelevel['id']) ?>"><?= esc($gradelevel['name']) ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="d-flex flex-row mt-3 justify-content-center overflow-scroll" style="max-height: 250px;">
                    <table class="table table-warning table-striped">
                        <thead><tr>
                            <th>Last</th>
                            <th>First</th>
                            <th>Grade</th>
                            <th>Team</th>
                        </tr></thead>
                        <tbody id="athlete-list"><tr></tr></tbody>
                    </table>
                </div>
                <div class="mt-3">
                    Athlete Count: <span id="athlete-count"></span>
                </div>
            </div>
        </div>
    </div>
</div>