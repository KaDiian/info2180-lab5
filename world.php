<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';


$country = filter_input(INPUT_GET, "country", FILTER_SANITIZE_STRING);

$context = filter_input(INPUT_GET, "context", FILTER_SANITIZE_STRING);

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
if(isset($_GET['context'])){
  $context = filter_input($_GET ["context"], FILTER_SANITIZE_STRING);
}

$country = filter_input($_GET, ["country"], FILTER_SANITIZE_STRING);
$search="countries";
if(isset($country)){
  $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
}
else{
  $stmt = $conn->query("SELECT * FROM countries");
}
if(isset($context)=="cities"){
  $search="cities";
  if(isset($country)){
    $stmt = $conn->query("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries ON cities.country_code WHERE countries.name LIKE '%$country%'");
  
  }else{
    $stmt = $conn->query("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries ON cities.country_code");
  }
}


$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php if($search == "countries"): ?>
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
    <td><?=$row['head_of_state'] ?></td>
  </tr>
  <?php endforeach; ?>

</table>
<?php endif; ?>
<?php if ($search == "cities"): ?>
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
<?php endif; ?>