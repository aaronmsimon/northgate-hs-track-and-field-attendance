
        <div class="d-flex flex-row justify-content-center mt-5">
            <div class="d-flex flex-column">
                <div class="d-flex flex-row justify-content-center">
                    <?= session()->getFlashdata('error') ?>
                    <?= validation_list_errors('studentid') ?>
                </div>
                <div class="d-flex flex-row justify-content-center">
                    <form action="/check-in" method="post" class="col-8">
                        <?= csrf_field() ?>

                        <div class="row">
                            <label for="student-id" class="form-label"><h5>Please enter your Student ID number to check in</h5></label>
                        </div>
                        <div class="my-4">
                            <input type="input" class="form-control-lg text-center" id="student-id" name="student-id" value="<?= set_value('title') ?>">
                        </div>
                        <button type="submit" class="btn btn-dark btn-lg">Check In</button>
                    </form>
                </div>
            </div>
        </div>