
        <div class="row mt-5">
            <h3>Thank you for checking in, <?= $athlete['firstname'] . ' ' . $athlete['lastname'] ?>!</h3>
        </div>
        <div class="d-flex flex-row mt-3 justify-content-center">
            <div class="col-8 alert alert-secondary">
                <div class="row">
                    <h3><?= (!is_null($message['author']) ? '"' : '') . $message['message'] . (!is_null($message['author']) ? '"' : ''); ?></h3>
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