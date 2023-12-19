const path = require('path');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CopyPlugin = require('copy-webpack-plugin');
const env = process.env.NODE_ENV || 'development';

module.exports = {
  entry: {
    app: './assets/js/index.js',
    editor: './assets/js/editor.js',
    admin: './assets/js/admin.js',
  },
  output: {
    path: path.resolve(__dirname, '../../../_dist'),
    filename: 'js/[name].min.js',
  },

  module: {
    rules: [
      {
        test: /\.jsx?$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
        },
      },
      {
        test: /\.css$/,
        use: ['style-loader', 'css-loader'],
      },
      {
        test: /\.s[ac]ss$/i,
        use: [
          // Extracts CSS into a different file
          MiniCssExtractPlugin.loader,
          // Translates CSS into CommonJS
          'css-loader',
          // Adds prefixes
          {
            loader: 'postcss-loader',
            options: {
              postcssOptions: {
                plugins: [
                  [
                    'postcss-preset-env',
                  ],
                  env === 'production' ? require('cssnano')({
                    preset: 'default',
                  }) : false,
                ],
              },
            },
          },
          // Compiles Sass to CSS
          {
            loader: 'sass-loader',
            options: {
              sourceMap: true,
              implementation: require('sass'),
              sassOptions: {
                includePaths: [
                  './assets/styles',
                ],
              },
              additionalData: `$env: ${env};`,
            },
          },
        ],
      },
      {
        test: /\.(woff|woff2|eot|ttf|otf)$/,
        type: 'asset/resource',
        generator: {
          filename: 'assets/fonts/[name][ext][query]',
        },
      },
      {
        test: /\.(png|jpe?g|gif|svg)$/i,
        type: 'asset/resource',
        generator: {
          filename: 'assets/img/[name][ext][query]',
        },
      },
    ],
  },
  resolve: {
    extensions: ['.js'],
  },
  plugins: [
    new MiniCssExtractPlugin({
      // For appropriate filenames in dist folder
      filename: (pathInfo) => {
        let base;

        if (pathInfo.chunk.name === 'app') {
          base = 'css/style';
        } else if (pathInfo.chunk.name === 'editor') {
          base = 'css/editor-style';
        } else {
          base = 'css/[name]';
        }

        return `${base}.min.css`;
      },
    }),
    new CopyPlugin({
      patterns: [
        {
          from: path.resolve(__dirname, './../../resource/img'),
          to: path.resolve(__dirname, '../../../_dist/assets/img'),
          globOptions: {
            ignore: ['**/*.scss'],
          },
        },
        {
          from: path.resolve(__dirname, './../../resource/fonts'),
          to: path.resolve(__dirname, '../../../_dist/assets/fonts'),
          globOptions: {
            ignore: ['**/*.scss'], 
          },
        },
      ],
    }),

    
    new CleanWebpackPlugin(),
  ].filter(Boolean),
};
