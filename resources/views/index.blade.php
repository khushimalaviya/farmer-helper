<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Send JS Value to PHP</title>
    @csrf
</head>
<body>
    <h1>Send JavaScript Variable to PHP using Form Submission</h1>

    <!-- Form with Hidden Input -->
    <form id="myForm" method="POST" action="{{ route('submit') }}">
        @csrf
        <input type="hidden" id="jsValue" name="jsValue">
        <button type="button" onclick="setValueToPHP()">Submit Form</button>
    </form>

    <script>
        function setValueToPHP() {
            let jsValue = "Hello from JavaScript!";
            document.getElementById('jsValue').value = jsValue;
            document.getElementById('myForm').submit();
        }
    </script>
</body>
</html>
