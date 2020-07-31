<!DOCTYPE html>
<html>
    <head>
        <title>DARiOX Debug Page</title>
        <style>
table{
    border: 1px solid black;
}
table * {
    border: 1px solid black;
}

h3{
    font-style:italic;
    max-width: 50%;
    min-width: 40%;
    border-bottom: 1px dashed darkgray;
}
        </style>
    </head>
    <body>
        <h1>DARiOX Debug</h1>
        <div class="cookies">
            <h3>Cookies</h3>
            <table>
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    foreach ($_COOKIE as $key => $value) {
                        print_r("<tr><td>".$key."</td><td>".json_encode($value)."</td></tr>");
                    }

                    ?>
                </tbody>
            </table>
        </div>
        <div class="custom">
            <h3>Miscellaneous</h3>
            <?php

            echo"'";print_r($_COOKIE['settings']['music']);echo"'";

             ?>
        </div>
    </body>
</html>
