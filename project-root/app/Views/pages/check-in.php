
        <?= session()->getFlashdata('error') ?>
        <?= validation_list_errors() ?>
        
        <form action="/check-in" method="post" class="container">
            <?= csrf_field() ?>

            <div class="row mt-3">
                <label for="student-id" class="form-label"><h3>Please enter your Student ID number to check in</h3></label>
            </div>
            <div class="my-5">
                <input type="input" class="form-control-lg" id="student-id" name="student-id" value="<?= set_value('title') ?>">
            </div>
            <button type="submit" class="btn btn-dark btn-lg">Check In</button>
        </form>