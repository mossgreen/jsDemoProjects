module.exports = {
  /** recommend to use cheap-module */
  devtool: 'eval-source-map', //generate source maps

  entry: __dirname + "/app/main.js",// the only entrance file
  output: {
    path: __dirname + "/public", //NOte: __dirname is the only global var in node.js
    filename: "bundle.js"
  },

  module: {
    loaders: [
      {
        test: /\.json$/,
        loader: "json"
      },
      {
        test: /\.js$/,
        exclude: /node_modules/,
        loader: 'babel'
      }
    ]
  },

  devServer: {
    contentBase: ".public",
    colors: true,
    historyApiFallback: true,
    inline: true
  }
}