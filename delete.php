<!doctype html>
<html lang="en">
<head>
    <!-- https://www.bootdey.com/snippets/view/single-advisor-profile#html -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/index.css" />
    <title>ASE 230 - class of Fall 2022</title>
</head>
<body>
    <?php
        include('csv_util.php');
        $author_file = 'csv/authors.csv';
        $quote_file = 'csv/quotes.csv';
        $authors_array = csvReturnArray($author_file);
        $quote_array = csvReturnArray($quote_file);
        $quote;
        $author;
    ?>
    <?php if (!$_POST) { 
        foreach($quote_array as $quote_key => $csvquote) {
            if ($quote_key ==$_GET['index']) {
                $quote = $csvquote[1];
                foreach($authors_array as $key => $csvauthor) {
                    if ($key == $csvquote[0]) {
                        $author = $csvauthor[0]  . " " . $csvauthor[1];
                    }
                }
            }
        }?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <h3>Would you like to delete the quote?</h3>
            <p><?php print($quote) ?></p<br><br>
            <p><?php print($author) ?></p>
            <br><br>
            <input type="hidden" name="index" value="<?php echo $_GET['index'] ?>">
            <input type="submit" value="Delete">
        </form>
    <?php } 
    else if ($_POST) {
        deleteRecord($quote_file, $_POST['index']);
        echo "Record deleted <br><a href=\"index.php\">Index Page</a>";
    }?> 
</body>