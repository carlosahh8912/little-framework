// Generated using webpack-cli https://github.com/webpack/webpack-cli

const path = require("path");
// const PhpManifestPlugin = require("webpack-php-manifest");
// const phpManifest = new PhpManifestPlugin(
//  { path: assets }
// );

module.exports = {
  resolve: {
    alias: {
      "@": path.resolve("resources/js"),
    },
  },
  module: {
    rules: [
      {
        test: /\.css$/i,
        use: ["style-loader", "css-loader"],
      },
    ],
  },
  mode: "development",
  // plugins: [phpManifest],
};
