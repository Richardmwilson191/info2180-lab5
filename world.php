<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$country = $_GET['country'];
$lookup = $_GET['lookup'] ?? null;

if ($lookup === 'cities') {
  $stmt = $conn->prepare("SELECT * FROM cities JOIN countries ON cities.country_code = countries.code WHERE countries.name LIKE :country");
  $stmt->bindValue(':country', "%$country%");
} else {
  $stmt = $conn->prepare("SELECT * FROM countries where name like :country");
  $stmt->bindValue(':country', "%$country%");
}

$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<?php if ($lookup === 'cities'): ?>
  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>District</th>
        <th>Population</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($results as $row): ?>
        <tr>
          <td><?= htmlspecialchars($row['name']); ?></td>
          <td><?= htmlspecialchars($row['district']); ?></td>
          <td><?= htmlspecialchars($row['population']); ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php else: ?>
  <table>
    <thead>
      <tr>
        <th>Country Name</th>
        <th>Continent</th>
        <th>Independence Year</th>
        <th>Head of State</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($results as $row): ?>
        <tr>
          <td><?= htmlspecialchars($row['name']); ?></td>
          <td><?= htmlspecialchars($row['continent']); ?></td>
          <td><?= htmlspecialchars($row['independence_year']); ?></td>
          <td><?= htmlspecialchars($row['head_of_state']); ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>