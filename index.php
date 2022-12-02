<?php

$hotels = [

  [
    'name' => 'Hotel Belvedere',
    'description' => 'Hotel Belvedere Descrizione',
    'parking' => true,
    'vote' => 4,
    'distance_to_center' => 10.4
  ],
  [
    'name' => 'Hotel Futuro',
    'description' => 'Hotel Futuro Descrizione',
    'parking' => true,
    'vote' => 2,
    'distance_to_center' => 2
  ],
  [
    'name' => 'Hotel Rivamare',
    'description' => 'Hotel Rivamare Descrizione',
    'parking' => false,
    'vote' => 1,
    'distance_to_center' => 1
  ],
  [
    'name' => 'Hotel Bellavista',
    'description' => 'Hotel Bellavista Descrizione',
    'parking' => false,
    'vote' => 5,
    'distance_to_center' => 5.5
  ],
  [
    'name' => 'Hotel Milano',
    'description' => 'Hotel Milano Descrizione',
    'parking' => true,
    'vote' => 2,
    'distance_to_center' => 50
  ],

];

// logica per filtrare gli hotel

// di default elenco da ciclare è tutto l'array
$selected_hotels = $hotels;


// vedo se dato esiste in get parking, non isset ma !empty, perchè verifica sia se esiste sia se è vuoto

if (!empty($_GET['parking'])) {
  //creo array dove pushare hotel filtrati
  $temp_hotels = [];

  // ciclo array hotels e pusho nel nuovo array solo hotel con parking
  foreach ($selected_hotels as $hotel) {
    if ($hotel['parking']) $temp_hotels[] = $hotel;
  }
  // sostityisco array selected con array temporaneo

  $selected_hotels = $temp_hotels;
}

if (isset($_GET['parking']) && empty($_GET['parking'])) {
  //creo array dove pushare hotel filtrati
  $temp_hotels = [];

  // ciclo array hotels e pusho nel nuovo array solo hotel con parking
  foreach ($selected_hotels as $hotel) {
    if (!$hotel['parking']) $temp_hotels[] = $hotel;
  }
  // sostityisco array selected con array temporaneo

  $selected_hotels = $temp_hotels;
}

if (!empty($_GET['vote'])) {
  $temp_hotels = [];
  foreach ($selected_hotels as $hotel) {
    if ($hotel['vote'] >= $_GET['vote']) $temp_hotels[] = $hotel;
  }

  $selected_hotels = $temp_hotels;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css' integrity='sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==' crossorigin='anonymous' />
  <title>PHP Hotel</title>
</head>

<body>

  <div class="container">
    <h1 class="my-5">Hotel PHP</h1>

    <form class="d-flex align-items-center" action="./index.php" method="GET">

      <div class="form-check me-3">
        <input class="form-check-input" type="radio" name="parking" id="noparking" value="">
        <label class="form-check-label" for="noparking">
          No parking
        </label>
      </div>

      <div class="form-check me-3">
        <input class="form-check-input" type="radio" name="parking" id="withparking" value="1">
        <label class="form-check-label" for="withparking">
          With parking
        </label>
      </div>

      <select class="form-select me-2 w-25" aria-label="Default select example" name="vote">
        <option selected value="">Select rating</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
      </select>

      <button class="btn btn-warning me-2" type="submit">Apply</button>
      <button class="btn btn-secondary" type="reset">Reset</button>

    </form>

    <table class="my-5 table table-striped">
      <thead>
        <tr>
          <th scope="col">Hotel Name</th>
          <th scope="col">Description</th>
          <th scope="col">Parking</th>
          <th scope="col">Rating</th>
          <th scope="col">Distance from center</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($selected_hotels as $hotel) : ?>
          <tr>
            <td>
              <?php echo $hotel['name'] ?>
            </td>
            <td>
              <?php echo $hotel['description'] ?>
            </td>
            <td>
              <?php echo $hotel['parking'] ? 'Yes' : 'No' ?>
            </td>
            <td>
              <?php echo $hotel['vote'] ?>
            </td>
            <td>
              <?php echo $hotel['distance_to_center'] ?>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>

  </div>

</body>

</html>