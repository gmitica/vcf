<?php
if (isset($_FILES["csvf"]) && $_FILES["csvf"] != "") {
    $path = $_FILES['csvf']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    if ($ext == "csv") {
        $folder = "/web/tmp/" . date("dmYHis") . "_" . rand() . "_";
        $csvFile = $folder . $_FILES['csvf']['name'];
        $vcfFile  = $folder . "ContactsMiticaSoftware.vcf";
        move_uploaded_file($_FILES['csvf']['tmp_name'], $csvFile);
        $fila = 1;
        if (($gestor = fopen($csvFile, "r")) !== FALSE) {
            $vcfTmpFile = fopen($vcfFile, "w") or die("Unable to open file!");
            $header = null;
            while (($datos = fgetcsv($gestor, 0, ";")) !== FALSE) {
                if ($header == null) {
                    $header = $datos;
                } else {
                    $a = array_combine($header, $datos);
                    $txt = "BEGIN:VCARD\nVERSION:2.1\n" .
                        "FN:" . $a['name'] . " " . $a["surname"] . "\n" .
                        "N:" . $a['surname'] . ";" . $a["name"] . ";;;" . "\n" .
                        "ORG:" . $a['organization'] . "\n" .
                        "TITLE:" . $a['rol'] . "\n";

                    for ($i = 0; $i < count($header); $i++) {
                        if (strpos($header[$i], 'email') !== false) {
                            $txt .= "EMAIL;" . str_replace("email-", "", $header[$i]) . ":" . $a[$header[$i]] . "\n";
                        }
                        if (strpos($header[$i], 'phone') !== false) {
                            $txt .= "TEL;" . str_replace("phone-", "", $header[$i]) . ":" . $a[$header[$i]] . "\n";
                        }
                    }
                    $txt .= "END:VCARD\n";
                    if ($a["name"] != null && $a["name"] != "") {
                        fwrite($vcfTmpFile, $txt);
                    }
                }
                $fila++;
            }
            fclose($vcfTmpFile);
            fclose($gestor);
        }
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename=' . basename($vcfFile));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($vcfFile));
        ob_clean();
        flush();
        readfile($vcfFile);
        unlink($vcfFile);
        unlink($csvFile);
        exit;
    }else{
        echo "Incorrect uploaded file";
    }
}