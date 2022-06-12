<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <title>CSV file import to Database</title>
</head>
<body>
<form action="<?php echo $_SERVER ["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="userfile" id="">
        <button type="submit">Upload</button>
    </form>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">Date</th>
      <th scope="col">Check No</th>
      <th scope="col">Description</th>
      <th scope="col">Amount</th>
    </tr>
  </thead>
  <tbody>
  <?php 
        // var_dump($transcations);

        foreach ($transcations as $record) {
            foreach ($record as $recordrow) {?>
              <tr>
                <td><?php echo $recordrow['tdate']; ?></td>
                <td><?php echo $recordrow['checkno']; ?></td>
                <td><?php echo $recordrow['tdescription']; ?></td>
                <td><?php echo $recordrow['tamount']; ?></td>
            </tr>
      <?php       }
        }
    ?>
  
  
  </tbody>
</table>
  
</body>
</html>