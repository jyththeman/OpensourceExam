<?php

$conn = new mysqli("localhost", "root", "", "test") or die (mysqli_error());

if(isset($_POST['submit'])){
$title = $_POST['title'];
$page = $_POST['page'];
$author = $_POST['author'];
$pubyear = $_POST['pubyear'];

$conn->query("INSERT INTO `user` VALUES('', '$title', '$page', '$author', '$pubyear')") or die (mysqli_error());
$conn->close();
echo "<script type='text/javascript'>alert('Successfully updated personal information!');</script>";
echo "<script>document.location='addbook.php'</script>";
    }
?>
<html>

<head>
	<title>Book Information</title>
    <link href="assets/css/reg.css" rel="stylesheet">
</head>

<body>
	<form action="addbook.php" method="post">
	<h1>Library Database</h1>
	<fieldset>
		<legend>Book Information</legend>
		<label>Title:</label> <input type="text" name="title" required/><br />
		<label>Pages:</label> <input type="number" min=1 name="page" required/><br />
		<label>Author:</label> <input type="text" name="author" required/><br />
		<label>Published Year:</label> <input type="text" name="pubyear" required/>
        <div><br/></div>
    <input style="float:right" type="submit" value="Add Book" name="submit"/>
    </fieldset>
    <h3>List of Stored Books</h3>
    <table border="2" align="center" cellpadding=5>
    <thead>
    <tr>
      <th>Title</th>
      <th>Pages</th>
      <th>Author</th>
      <th>Published Year</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php 
$query = $conn->query("select * from `user`") or die (mysqli_error());
while ($fetch = $query->fetch_array()){
?>
<tr>
    <td><?php echo $fetch['title']?></td>
    <td><?php echo $fetch['page']?></td>
    <td><?php echo $fetch['author']?></td>
    <td><?php echo $fetch['pubyear']?></td>
    <td><a href="addbook.php?id=<?php echo $fetch['primarykey']?>" ><i class="icon-eye-open"></i>edit</a></td>
</tr>
<?php
}
$conn->close();
?>
    
  </tbody>
        </table>
	</form>

</body>
</html>