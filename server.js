const { createServer } = require("http");
const { Server } = require("socket.io");
const mysql = require("mysql");
const fs = require("fs");
function readJSON(path) {
  const content = fs.readFileSync(path).toString();
  return JSON.parse(content);
}
const databaseConfig = readJSON("database_config.json");
const connection = mysql.createConnection({
  host: databaseConfig.host,
  user: databaseConfig.username,
  password: databaseConfig.password,
  database: databaseConfig.database
});
connection.connect(error => {
  if (error) throw error;
});
async function databasePushChat(message) {
  const sql = `INSERT INTO messages(message) VALUES("${message}")`;
  connection.query(sql, error => {
    if (error) throw error;
  });
}
const httpServer = createServer();
const server = new Server(httpServer, {
  cors: "*"
});
server.on("connection", connectingClient => {
  connectingClient.on("new message", message => {
    databasePushChat(message);
    server.emit("push message", message);
  });
});
httpServer.listen(1337);