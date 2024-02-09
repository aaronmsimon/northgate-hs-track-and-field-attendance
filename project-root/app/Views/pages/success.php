
        <div class="row mt-3">
            <h3>Thank you for checking in, <?= $athlete['firstname'] . ' ' . $athlete['lastname'] ?>!</h3>
        </div>
        <div class="d-flex flex-row mt-5 justify-content-center">
            <div class="col-6 alert alert-secondary">
                <div class="row">
                    <h3>"<?= $message['message'] ?>"</h3>
                </div>
                <?php if (!is_null($message['author']))
                {
                    ?>
                    <div class="d-flex flex-row mt-3 justify-content-end">
                        <h3>- <?= $message['author'] ?></h3>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>