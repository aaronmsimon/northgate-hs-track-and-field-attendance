<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= esc($title) ?></title>

    <style>
        body {
            background-color: #9c1f2e;
            color: #FFF;

            margin: 0;
            font-family: Arial, sans-serif;
        }
        
        .container {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        #header {
            height: 25vh;
            font-size: 30px;
        }

        #footer {
            height: 15vh;
            font-size: 15px;
        }

        #check-in {
            height: 25vh;
            font-size: 35px;
            align-items: flex-start;
        }

        form {
            height: 35vh;
            font-size: 35px;
            align-content: flex-start;
        }

        .left-image {
            max-width: 100%; /* Ensure the image does not exceed its container */
            height: auto; /* Maintain the aspect ratio */
            margin-right: 20px; /* Adjust the spacing between image and text */
        }

        .centered-text {
            text-align: center;
        }

        /* Mobile optimization */
        @media (max-width: 768px) {
            .container {
                flex-direction: column; /* Stack items vertically on smaller screens */
                text-align: center;
            }

            .left-image {
                margin-bottom: 20px; /* Add space between image and text on smaller screens */
            }
        }
    </style>

    <link rel="icon" type="image/png" href="https://5starassets.blob.core.windows.net/athleticsites/2635116/994/images/a2ccd442-0072-4013-b8bb-d58516574056.png">
</head>
<body>

    <div id="header" class="container">
        <img src="<?= base_url() ?>img/BroncosOfficialLogo2016yellowgold.png" width="250" alt="Northgate Broncos" class="left-image"></img>
        <div class="centered-text">
            <p>Northgate Broncos Track & Field Attendance</p>
        </div>
    </div>