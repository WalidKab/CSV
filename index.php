<?php
$file = fopen("grille_transport_dex.csv", "r+");
$csvFinal = fopen("dext.csv", "w");
$csv = fgetcsv(
    $file
);

$row = 1;
$column = 1;
$data_set = [];
if (($handle = fopen("grille_transport_dex.csv", "r+")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $data_set[] = $data;
    }

    foreach (range(0, 9) as $item) {
        $departement_list = ($data_set[0][$item]);

        $departement_array = str_replace("\n", ",", str_replace(" ", ",", $departement_list));
        $departement_array = explode(",", $departement_array);

        foreach ($departement_array as $department) {
            echo ($department) . "<br/>";
            $department = $department . "%";
            foreach (range(1, 10) as $row) {
                $final = ($data_set[$row][0]) . " = " . ($data_set[$row][$item + 1]) . " | ";
                echo $final;
                fputcsv($csvFinal, [$department, $data_set[$row][0], $data_set[$row][$item + 1]]);

            }
            echo "<br/>";
        }
    }

    fclose($handle);
}