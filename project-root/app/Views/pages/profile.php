<script>
    $(document).ready(function(){
        function shadeAttendance() {
            data = <?= $attendance ?>;
            offset = new Date().getTimezoneOffset();
            for (let i = 0; i < data.length; i++) {
                let att = new Date(new Date(data[i].checkindate).getTime() + offset * 60000);
                if (att.getMonth() + 1 == $("#cal-month").val()) {
                    $("#cal-date-" + att.getDate()).css("color","#9c1f2e").css("background-color","#FDC82F");
                    if (att.getDate() < 10) {
                        $("#cal-date-" + att.getDate()).children().css("color","#FDC82F");
                    }
                }
            }
        }

        function updateMonth() {
            var year = new Date().getFullYear();
            var month = $("#cal-month").val();
            var lastDay = new Date(year, month, 0);
            var firstDayOfMonth = new Date(year, month - 1, 1);
            var monthNames = ["January","February","March","April","May","June","July","August","September","October","November","December"];

            var weekIndex = 0;

            $(".week").remove();

            // Pad first week
            if (firstDayOfMonth.getDay() > 0) {
                $("#calendar").append('<div class="d-flex flex-row mt-2 week" id="week' + weekIndex + '"></div>');
                for (let i = 0; i < firstDayOfMonth.getDay(); i++) {
                    $("#week" + weekIndex).append('<div class="col"><div class="mx-1 fs-6 badge rounded-pill" style="color:#9c1f2e;">00</div></div');
                }
            }
            for (let i = 0; i < lastDay.getDate(); i++) {
                var day = i + 1;
                if (new Date(year, month - 1, day).getDay() == 0) {
                    weekIndex++;
                    $("#calendar").append('<div class="d-flex flex-row mt-3 week" id="week' + weekIndex + '"></div>');
                }
                if (new Date(year, month - 1, day) <= new Date()) {
                    style = "color: #9c1f2e;background-color: #FFF;";
                    if (day < 10) {
                        daytext = '<span style="color:#FFF;">0</span>' + day;
                    } else {
                        daytext = day;
                    }
                } else {
                    style = "color: #FFF;background-color: #9c1f2e;";
                    if (day < 10) {
                        daytext = '<span style="color:#9c1f2e;">0</span>' + day;
                    } else {
                        daytext = day;
                    }
                }
                $("#week" + weekIndex).append('<div class="col"><div class="mx-1 fs-6 badge rounded-pill" style="' + style + '" id="cal-date-' + day + '">' + daytext + '</div></div');
            }
            // Pad last week
            if (lastDay.getDay() < 6) {
                for (let i = lastDay.getDay() + 1; i < 7; i++) {
                    $("#week" + weekIndex).append('<div class="col"></div');
                }
            }
            // Mark days with attendance
            shadeAttendance();
        }

        updateMonth();
        
        $("#cal-month").change(function(){
            updateMonth();
        });

    });
</script>

<div class="container-fluid">
    <div class="row justify-content-center">
        <table class="table">
            <tbody>
                <tr>
                    <td rowspan="4" class="align-middle">
                        <h3><?= $athlete['firstname'] . ' ' . $athlete['lastname'] ?></h3>
                        <div>
                            <?php
                                foreach ($eligibility as $issue) {
                                    echo '<span class="badge text-bg-danger ms-1">' . $issue['eligibilityissue'] . '</span>';
                                }
                            ?>
                        </div>
                    </td>
                    <td>Student ID: <?= $athlete['studentid'] ?></td>
                </tr>
                <tr>
                    <td>Team: <?= $athlete['team'] ?>s</td>
                </tr>
                <tr>
                    <td>Grade: <?= $athlete['grade'] ?></td>
                </tr>
                <tr>
                    <td>DOB: <?= $athlete['dob'] ?></td>
                </tr>
            </tbody>
        </table>

        <h4 class="mt-3">Attendance</h4>
        <div class="col-10" id="calendar">
            <div class="row my-3">
                <div class="col" id="month-name">
                    <select class="form-select w-auto me-3" id="cal-month">
                        <?php for ($i = 0; $i < 12; $i++): ?>
                            <option value="<?= $i + 1 ?>" <?php if ($i + 1 == Date('m')) {echo 'selected';}?>><?= date_format(date_create(date("Y") . "-" . $i + 1 . "-1"),"F") ?></option>
                        <?php endfor ?>
                    </select>
                </div>
            </div>
            <div class="d-flex flex-row" id="cal-head">
                <div class="col">S</div>
                <div class="col">M</div>
                <div class="col">T</div>
                <div class="col">W</div>
                <div class="col">T</div>
                <div class="col">F</div>
                <div class="col">S</div>
            </div>
        </div>
    </div>
</div>