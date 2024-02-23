<?php
$content = file_get_contents("database_config.json");
$databaseConfig = json_decode($content);
$connection = mysqli_connect(
    $databaseConfig->host,
    $databaseConfig->username,
    $databaseConfig->password,
    $databaseConfig->database
);
$rows = $connection->query("SELECT message FROM messages");
$result = [];
while ($row = $rows->fetch_assoc()) {
    $result[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Socket.io</title>
</head>

<body>

    <div id="message">
        <ul>
            <li>
                Hehehehehehe
            </li>
            <li>
                Hahahahahaha
            </li>
            <li>
                Huhuhuhuhuhu
            </li>
            <?php
            foreach ($result as $row) {
                echo "<li>" . $row["message"] . "</li>";
            }
            ?>
        </ul>
    </div>
    <input type="text" size="64" id="messageText">
    <input type="submit" id="send">
    <script src="https://cdn.socket.io/4.7.4/socket.io.min.js"
        integrity="sha384-Gr6Lu2Ajx28mzwyVR8CFkULdCU7kMlZ9UthllibdOSo6qAiN+yXNHqtgdTvFXMT4"
        crossorigin="anonymous"></script>
    <script>
        const socket = io("http://localhost:1337")
        const sendButton = document.getElementById("send");
        sendButton.onclick = function () {
            const inputText = document.getElementById("messageText");
            socket.emit("new message", inputText.value);
            inputText.value = "";
        }
        socket.on("push message", message => {
            document.querySelector("ul").innerHTML += `<li>${message}</li>`;
        });
    </script>
</body>

</html>