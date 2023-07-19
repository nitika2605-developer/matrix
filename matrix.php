<!DOCTYPE html>
<html>

<head>
    <title>Matrix Printing with Color and Size</title>
</head>

<body>
    <form method="post">
        Number of Colors: <input type="number" name="num_colors" min="1" required><br>
        Number of Sizes: <input type="number" name="num_sizes" min="1" required><br>
        Color Labels (separate by comma): <input type="text" name="color_labels" required><br>
        Size Labels (separate by comma): <input type="text" name="size_labels" required><br>
        <input type="submit" value="Generate Matrix">
    </form>
</body>

</html>
<?php
// Function to create the matrix
function createMatrix($numColors, $numSizes, $colorLabels, $sizeLabels)
{
    $matrix = array();

    for ($i = 0; $i < $numColors; $i++) {
        for ($j = 0; $j < $numSizes; $j++) {
            $colorSizeArray = array();
            for ($k = 0; $k <= 10; $k++) {
                $colorSizeArray[] = $k;
            }
            $matrix[$i][$j] = $colorSizeArray;
        }
    }
    echo "<table border='1'>";
    echo "<tr><th></th>";
    // table header
    foreach ($sizeLabels as $size) {
        echo "<th>$size</th>";
    }
    echo "</tr>";
    for ($i = 0; $i < $numColors; $i++) {
        echo "<tr>";
        // color background
        echo "<td style='background-color: $colorLabels[$i];'></td>";
        for ($j = 0; $j < $numSizes; $j++) {
            echo "<td>";
            // Print numbers
            foreach ($matrix[$i][$j] as $num) {
                echo "$num ";
            }
            echo "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
// form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numColors = (int)$_POST["num_colors"];
    $numSizes = (int)$_POST["num_sizes"];
    $colorLabels = explode(",", $_POST["color_labels"]);
    $sizeLabels = explode(",", $_POST["size_labels"]);

    if ($numColors <= 0 || $numSizes <= 0) {
        echo "Please enter valid values for the number of colors and sizes.";
    } elseif (count($colorLabels) !== $numColors || count($sizeLabels) !== $numSizes) {
        echo "Please provide the correct number of color and size labels.";
    } else {
        createMatrix($numColors, $numSizes, $colorLabels, $sizeLabels);
    }
}
?>