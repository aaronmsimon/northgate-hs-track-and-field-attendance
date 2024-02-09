        <div id="check-in" class="container">
            <p>Please enter your Student ID number to check in</p>
        </div>
        
            <?= session()->getFlashdata('error') ?>
            <?= validation_list_errors() ?>
            
            <form action="/check-in" method="post" class="container">
                <?= csrf_field() ?>
                
                <input type="input" name="student-id" value="<?= set_value('title') ?>">
                <br>
                
                <input type="submit" name="submit" value="Check In">
            </form>