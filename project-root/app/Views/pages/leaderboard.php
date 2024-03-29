        <div class="row mt-4">
            <div class="col-8 mx-auto overflow-auto" style="max-height: 250px;">
                <table class="table table-light">
                    <thead>
                        <tr>
                            <th scope="col" class="col-6">Athlete</th>
                            <th scope="col">Check-Ins</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($attendance as $student): ?>
                        <tr>
                            <td class="col-6 text-start ps-4"><?= esc($student['firstname']) . ' ' . esc($student['lastname']) ?></td>
                            <td class="text-end pe-4"><?= esc($student['checkins']) ?></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-8 mx-auto overflow-auto" style="max-height: 250px;">
                <table class="table table-light">
                    <thead>
                        <tr>
                            <th scope="col" class="col-6">Athlete</th>
                            <th scope="col">Perfect Weeks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($completeweeks as $student): ?>
                        <tr>
                            <td class="col-6 text-start ps-4"><?= esc($student['firstname']) . ' ' . esc($student['lastname']) ?></td>
                            <td class="text-end pe-4"><?= esc($student['completeweeks']) ?></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>