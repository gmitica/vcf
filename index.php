<!DOCTYPE html>
<html lang="en">
<head>
    <title>CREATE VCF | MiticaSoftware</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Create your vcf from an excel sheet">
    <meta name="keywords" content="vcf, contacts, create vcf, miticasoftware, vcf excel, vcf csv">
    <meta name="author" content="George Mitica">
    <meta name="robots" content="index, nofollow">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="CREATE VCF | MiticaSoftware" />
    <meta property="og:description" content="Create your vcf from an excel sheet" />
    <meta property="og:image" content="https://vcf.miticasoftware.com/img/favicon.svg" />
    <meta property="og:url" content="https://vcf.miticasoftware.com/" />

    <?php include $_SERVER["DOCUMENT_ROOT"] . "/com/head.php"; ?>
    <script>
        $(document).ready(function() {
            $("#customFile").change(function() {
                var filename = document.getElementById('customFile').files[0].name;
                if (filename.includes(".csv")) {
                    $('#forma').submit();
                } else {
                    showNotify("Incorrect uploaded file", true, 4);
                }
            });
        });
    </script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">CREATE VCF</h1>
        <h2>How to use?</h2>
        <ol>
            <li>Download Excel file. <a href="/download/vcf.xlsx" download>DOWNLOAD</a></li>
            <li>Fill in fields<br>
                The first column named "null" should not be modified.
                The columns that follow with the name "phone" and "email" are dynamic, they can create as many as needed. The hyphen "-" after the name is mandatory, after the hyphen you must write the name of the tag, which will be visible to each contact.
            </li>
            <li>Export file to csv</li>
            <li>Upload csv file</li>
        </ol>
        <form action="upload.php" id="forma" method="post" enctype="multipart/form-data">
            <div class="custom-file mb-3">
                <input type="file" class="custom-file-input" id="customFile" name="csvf">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
        </form>
    </div>
    <script>
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
</body>
<?php include $_SERVER["DOCUMENT_ROOT"] . "/com/footer.php"; ?>
</html>