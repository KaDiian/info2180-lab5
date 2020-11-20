<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';


$country = filter_input(INPUT_GET, "country", FILTER_SANITIZE_STRING);
$context = filter_input(INPUT_GET, "context", FILTER_SANITIZE_STRING);

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");

$stmt = $conn->query("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries ON cities.country_code WHERE countries.name LIKE '%$country%'");

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php if(!isset($context)): ?>
<table> 
<tr> 
  <th>Name</th>
  <th>Continent</th>
  <th>Independence</th>
  <th>Head of State</th>
</tr>

<?php foreach ($results as $row): ?>
  <tr>
    <td><?=$row['name'] ?></td>
    <td><?=$row['continent'] ?></td>
    <td><?=$row['independence_year'] ?></td>
    <td><?= $row['head_of_state'] ?></td>
  </tr>
  <?php endforeach; ?>

</table>

<?php elseif (isset($context)): ?>
<table> 
<tr> 
  <th>Name</th>
  <th>Distinct</th>
  <th>Population</th>
</tr>

<?php foreach ($results as $row): ?>
  <tr>
    <td><?=$row['name'] ?></td>
    <td><?=$row['distinct'] ?></td>
    <td><?=$row['population'] ?></td>
  </tr>
  <?php endforeach; ?>

</table>
<?php endif ?>