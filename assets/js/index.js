// style
import '../css/style.scss';

// components

function importAll(r) {
  r.keys().forEach(r);
}

importAll(require.context('./../../assets/resource/fonts/', true, /\.(woff|woff2|eot|ttf|otf)$/));

// Импортируем все файлы js и scss из каждой подпапки 'components'
importAll(require.context('./../../components', true, /\.js$/));
importAll(require.context('./../../components', true, /\.scss$/));

// Импортируем все файлы js и scss из каждой подпапки 'blocks'
importAll(require.context('./../../blocks', true, /\.js$/));
importAll(require.context('./../../blocks', true, /\.scss$/));

// Импортируем все файлы js папки 'utils'
importAll(require.context('./utils', true, /\.js$/));
