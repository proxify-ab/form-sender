<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <title>Pictures mailer</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="{{mix('css/form-sender.css')}}" rel="stylesheet">
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            Pictures mailer
        </div>

        <div id="dropzone">
            <form action="/api/files/upload" class="my-dropzone needsclick dz-clickable" id="dropzone-form">

                <div class="dz-message needsclick">
                    Drop files here or click to upload.<br>
                    <span class="note needsclick">
                        (Selected files will be uploaded and sended to the email as attachment)
                    </span>
                </div>

            </form>
        </div>

    </div>
</div>
<script type="text/javascript" src="{{mix('js/form-sender.js')}}"></script>
</body>
</html>
