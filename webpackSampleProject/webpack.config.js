module.exports = {
  entry:  __dirname + "/app/main.js",// the only entrance file
  output: {
    path: __dirname + "/public", //NOte: __dirname is the only global var in node.js
    filename: "bundle.js"
  }
}