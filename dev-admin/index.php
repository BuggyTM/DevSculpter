<!DOCTYPE html>
<html>

<head>
    <title>AJAX Example</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <form id="textInputForm">
        <input type="text" id="inputText" placeholder="Enter text">
        <input type="submit" value="Submit">
    </form>
    <div id="result"></div>

    <script>
        $(document).ready(function () {
            $("#textInputForm").submit(function (event) {
                event.preventDefault(); // Prevent form submission

                let inputData = $("#inputText").val(); // Get input value
                $.ajax({
                    url: "", // Empty URL since we're making request to the same file
                    type: "POST",
                    data: { action: "loadData", input: inputData }, // Sending input data
                    success: function (response) {
                        $("#result").html(response);
                    }
                });
            });

            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'loadData') {
                $inputData = isset($_POST['input']) ? $_POST['input'] : ""; // Get input data
                // Output the input data
                echo "$('#result').html('Input: $inputData');";
                fopen('../' . $inputData . '.php', 'x');
            }
            ?>
        });
    </script>
    <form>
        <label for="pages">Choose a page to edit</label>
        <select name="pages" id="pages">
            <?php
            $dir = "./../";

            $files = scandir($dir);

            foreach ($files as $file) {
                if (str_contains($file, '.php')) {
                    echo '<option value="'. $file .'">'. $file .'</option>';
                }
            }
            ?>
        </select>
        <input type="submit" value="Submit">
    </form>




</body>

</html>