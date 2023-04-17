<!DOCTYPE html>
<html>
<head>
  <title>Minecraft Server Player Grid</title>
  <style>
    body {
      background-color: black;
    }

    img {
      margin: 2px;
    }

    .player-grid {
      background-color: rgba(255, 255, 255, 0.1);
      padding: 10px 30px;
      border-radius: 5px;
      display: inline-block;
    }

    .container {
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="container">
    <script>
      // Define the server IP address and port number
      const serverIP = "YOUR.IP.ADDRESS.HERE";
      const serverPort = "25565";

      // Define the number of players to display in the grid
      const maxPlayers = 50;

      // Fetch the server data using the server IP and port number
      fetch(`https://api.minetools.eu/query/${serverIP}/${serverPort}`)
        .then(response => response.json())
        .then(data => {
          // Get the player list from the server data
          const playerList = data.Playerlist;

          // Create a container element to hold the player heads
          const container = document.createElement("div");
          container.classList.add("player-grid");

          // Loop through each player in the player list
          for (let i = 0; i < Math.min(maxPlayers, playerList.length); i++) {
            // Create a new image element for each player head
            const img = document.createElement("img");

            // Check if the player's name is "Anonymous Player"
            if (playerList[i] === "Anonymous Player") {
              // Set the image source for a "hidden" player
              img.src = "https://www.example.com/anon_player.png";
            } else {
              // Set the image source to the player head URL
              img.src = `https://minotar.net/avatar/${playerList[i]}/64`;
            }

            // Set the title attribute of the image element to the player's name
            img.title = playerList[i];

            // Add the image element to the container
            container.appendChild(img);

            // Add a line break after every 10th image
            if ((i + 1) % 10 === 0) {
              container.appendChild(document.createElement("br"));
            }
          }

          // Add the container to the document
          document.body.appendChild(container);
        })
        .catch(error => console.error(error));
    </script>
  </div>
</body>
</html>
