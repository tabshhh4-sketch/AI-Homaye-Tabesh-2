const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = [
  // Admin app configuration
  {
    name: 'admin',
    entry: './assets/js/src/index.js',
    output: {
      path: path.resolve(__dirname, 'assets/dist'),
      filename: 'admin-app.js',
    },
    module: {
      rules: [
        {
          test: /\.jsx?$/,
          exclude: /node_modules/,
          use: {
            loader: 'babel-loader',
            options: {
              presets: ['@babel/preset-env', '@babel/preset-react'],
            },
          },
        },
        {
          test: /\.css$/,
          use: [MiniCssExtractPlugin.loader, 'css-loader'],
        },
      ],
    },
    plugins: [
      new MiniCssExtractPlugin({
        filename: 'admin-app.css',
      }),
    ],
    resolve: {
      extensions: ['.js', '.jsx'],
    },
    externals: {
      '@wordpress/element': ['wp', 'element'],
      '@wordpress/components': ['wp', 'components'],
      '@wordpress/i18n': ['wp', 'i18n'],
    },
  },
  // Frontend chatbot configuration
  {
    name: 'frontend',
    entry: './assets/js/src/frontend/index.js',
    output: {
      path: path.resolve(__dirname, 'assets/dist'),
      filename: 'chatbot-app.js',
    },
    module: {
      rules: [
        {
          test: /\.jsx?$/,
          exclude: /node_modules/,
          use: {
            loader: 'babel-loader',
            options: {
              presets: ['@babel/preset-env', '@babel/preset-react'],
            },
          },
        },
        {
          test: /\.css$/,
          use: [MiniCssExtractPlugin.loader, 'css-loader'],
        },
      ],
    },
    plugins: [
      new MiniCssExtractPlugin({
        filename: 'chatbot-app.css',
      }),
    ],
    resolve: {
      extensions: ['.js', '.jsx'],
    },
  },
];
