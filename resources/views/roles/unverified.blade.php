<!DOCTYPE html>
<html>
    <head>
        <title>Account Unverified.</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100,400" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato', sans-serif;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
            
            .text {
                font-weight: 400;
                padding: 25px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">
                  Unverified.
                </div>
                <div class="text">
                  If you've already donated a minimum of $5 please hold on. It could take a day or two as PayPal sometimes takes
                  a while to clear and we're doing this manually for now. If it's been more than 4 days, please post an issue 
                  <a href="https://github.com/halfpetal/Support/issues" target="_blank">here</a>. Thank you.
                  <br/><br/>
                  If you have not donated, it could take 20-30 days (or more) to verify your account. If you would like to speed up
                  that process, please considering <a href="{{ route('donate') }}" target="_blank">donating to CapesAPI</a>. Minimum
                  of $5 is required for shorter verification time.
                </div>
            </div>
        </div>
    </body>
</html>
