'use strict';

var _gulp = require('gulp');

var _gulp2 = _interopRequireDefault(_gulp);

var _gulpLoadPlugins = require('gulp-load-plugins');

var _gulpLoadPlugins2 = _interopRequireDefault(_gulpLoadPlugins);

var _browserSync = require('browser-sync');

var _browserSync2 = _interopRequireDefault(_browserSync);

var _vinylFtp = require('vinyl-ftp');

var _vinylFtp2 = _interopRequireDefault(_vinylFtp);

var _del = require('del');

var _del2 = _interopRequireDefault(_del);

var _wiredep = require('wiredep');

var _imageminPngcrush = require('imagemin-pngcrush');

var _imageminPngcrush2 = _interopRequireDefault(_imageminPngcrush);

var _fs = require('fs');

var _fs2 = _interopRequireDefault(_fs);

var _jade = require('jade');

var _jade2 = _interopRequireDefault(_jade);

var _phpjade = require('phpjade');

var _phpjade2 = _interopRequireDefault(_phpjade);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var $ = (0, _gulpLoadPlugins2.default)(); // generated on 2015-10-20 using generator-gulp-webapp 1.0.3

var reload = _browserSync2.default.reload;

var info = JSON.parse(_fs2.default.readFileSync('./package.json'));

_phpjade2.default.init(_jade2.default);

_gulp2.default.task('styles', function () {
  return _gulp2.default.src('app/styles/*.scss').pipe($.plumber()).pipe($.sourcemaps.init()).pipe($.sass.sync({
    outputStyle: 'expanded',
    precision: 10,
    includePaths: ['.']
  }).on('error', $.sass.logError)).pipe($.autoprefixer({ browsers: ['last 1 version'] })).pipe($.sourcemaps.write()).pipe(_gulp2.default.dest('.tmp/styles')).pipe(reload({ stream: true }));
});

function lint(files, options) {
  return function () {
    return _gulp2.default.src(files).pipe(reload({ stream: true, once: true })).pipe($.eslint(options)).pipe($.eslint.format()).pipe($.if(!_browserSync2.default.active, $.eslint.failAfterError()));
  };
}

_gulp2.default.task('lint', lint('app/scripts/**/*.js'));

_gulp2.default.task('html', ['views', 'styles'], function () {
  var assets = $.useref.assets({ searchPath: ['.tmp', '.tmp/includes', 'app', '.'] });

  return _gulp2.default.src(['app/*.html', '.tmp/**/*.html', '.tmp/**/*.php']).pipe(assets).pipe($.if('*.js', $.uglify())).pipe($.if('*.css', $.minifyCss({ compatibility: '*' }))).pipe(assets.restore()).pipe($.useref()).pipe($.if('*.html', $.minifyHtml({ conditionals: true, loose: true }))).pipe(_gulp2.default.dest('dist'));
});

_gulp2.default.task('views', function () {
  return _gulp2.default.src(['app/**/*.jade', '!app/layouts/**']).pipe($.jade({
    jade: _jade2.default,
    usestrip: true,
    pretty: true,
    prefunction: function prefunction(input, options) {
      return input.replace(/###/, 'hello');
    }
  })).pipe($.if('*.php.html', $.rename({ extname: '' }))).pipe(_gulp2.default.dest('.tmp')).pipe(reload({ stream: true }));
});

_gulp2.default.task('images', function () {
  return _gulp2.default.src('app/images/**/*').pipe($.if($.if.isFile, $.cache($.imagemin({
    progressive: true,
    interlaced: true,
    // don't remove IDs from SVGs, they are often used
    // as hooks for embedding and styling
    svgoPlugins: [{ cleanupIDs: false }],
    use: [(0, _imageminPngcrush2.default)({ reduce: true })]
  })).on('error', function (err) {
    console.log(err);
    undefined.end();
  }))).pipe(_gulp2.default.dest('.tmp/images')).pipe(_gulp2.default.dest('dist/images'));
});

_gulp2.default.task('fonts', function () {
  return _gulp2.default.src(require('main-bower-files')({
    filter: '**/*.{eot,svg,ttf,woff,woff2}'
  }).concat('app/fonts/**/*')).pipe(_gulp2.default.dest('.tmp/fonts')).pipe(_gulp2.default.dest('dist/fonts'));
});

_gulp2.default.task('extras', function () {
  return _gulp2.default.src(['app/**/*', '!app/{layouts,layouts/**}', '!app/{images,images/**}', '!app/{fonts,fonts/**}', '!app/**/*.html', '!app/**/*.scss', '!app/**/*.jade'], {
    dot: true
  }).pipe(_gulp2.default.dest('dist'));
});

_gulp2.default.task('clean', _del2.default.bind(null, ['.tmp', 'dist']));
_gulp2.default.task('clean:modules', _del2.default.bind(null, ['bower_components', 'node_modules']));
_gulp2.default.task('clean:all', ['clean', 'clean:modules'], function () {
  console.log('you need to run the following command before the next build :');
  console.log('npm install && bower install');
});

_gulp2.default.task('serve', ['views', 'styles', 'fonts', 'images'], function () {
  (0, _browserSync2.default)({
    notify: false,
    port: 9000,
    server: {
      baseDir: ['.tmp', 'app'],
      routes: {
        '/bower_components': 'bower_components'
      }
    },
    startPath: '/static/'
  });

  _gulp2.default.watch(['app/*.html', '.tmp/**/*.html', 'app/scripts/**/*.js', 'app/images/**/*', '.tmp/fonts/**/*']).on('change', reload);

  _gulp2.default.watch('app/**/*.jade', ['views']);
  _gulp2.default.watch('app/styles/**/*.scss', ['styles']);
  _gulp2.default.watch('app/fonts/**/*', ['fonts']);
  _gulp2.default.watch('app/images/**/*', ['images']);
  _gulp2.default.watch('bower.json', ['wiredep', 'fonts']);
});

_gulp2.default.task('serve:dist', function () {
  (0, _browserSync2.default)({
    notify: false,
    port: 9000,
    server: {
      baseDir: ['dist'],
      'index': 'mockup.html'
    }
  });
});

// inject bower components
_gulp2.default.task('wiredep', function () {
  _gulp2.default.src('app/styles/*.scss').pipe((0, _wiredep.stream)({
    ignorePath: /^(\.\.\/)+/
  })).pipe(_gulp2.default.dest('app/styles'));

  _gulp2.default.src(['app/layouts/*.jade']).pipe((0, _wiredep.stream)({
    exclude: ['jquery', 'bootstrap-sass', 'modernizr'],
    ignorePath: /^(\.\.\/)*\.\./
  })).pipe(_gulp2.default.dest('app/layouts/'));
});

var config = JSON.parse(_fs2.default.readFileSync('./.deployrc'));

function getDeployStream(configSet) {

  if (!_fs2.default.statSync('./.deployrc').isFile()) {
    throw new $.util.PluginError({
      plugin: 'deploy',
      message: '.deployrc config file not found'
    });
  } else {

    return _vinylFtp2.default.create({
      host: configSet.host,
      port: configSet.port,
      user: configSet.user,
      password: configSet.password,
      log: $.util.log
    });
  }
}

_gulp2.default.task('deploy:prod', ['build'], function () {

  var conn = getDeployStream(config.prod);

  return _gulp2.default.src('dist/**', {
    base: 'dist',
    buffer: false
  }).pipe(conn.dest(config.prod.path));
});

_gulp2.default.task('deploy:dev', ['build'], function () {

  var conn = getDeployStream(config.dev);

  return _gulp2.default.src('dist/**', {
    base: 'dist',
    buffer: false
  }).pipe(conn.dest(config.dev.path));
});

_gulp2.default.task('deploy:local', ['build'], function () {
  console.log("local deploy!");

  return _gulp2.default.src('dist/**/*').pipe(_gulp2.default.dest(config.local.path));
  console.log("copying dist to " + config.local.path);
});

_gulp2.default.task('deploy:watch', function () {

  var conn = getDeployStream(config.dev);

  var up = function up(file, base) {
    return _gulp2.default.src([file], { base: base, buffer: false }).pipe(conn.newer(config.dev.path)) // only upload newer files
    .pipe(conn.dest(config.dev.path));
  };

  _gulp2.default.watch(['.tmp/**/*']).on('change', function (event) {
    console.log('Changes detected! Uploading file "' + event.path + '", ' + event.type);
    return up(event.path, '.tmp');
  });

  _gulp2.default.watch(['app/**/*', '!app/{layouts,layouts/**}', '!app/{images,images/**}', '!app/{fonts,fonts/**}', '!app/**/*.html', '!app/**/*.scss', '!app/**/*.jade']).on('change', function (event) {
    console.log('Changes detected! Uploading file "' + event.path + '", ' + event.type);
    return up(event.path, 'app');
  });

  _gulp2.default.watch('app/**/*.jade', ['views']);
  _gulp2.default.watch('app/styles/**/*.scss', ['styles']);
  _gulp2.default.watch('app/fonts/**/*', ['fonts']);
  _gulp2.default.watch('app/images/**/*', ['images']);
  _gulp2.default.watch('bower.json', ['wiredep', 'fonts']);
});

_gulp2.default.task('build', ['lint', 'html', 'images', 'fonts', 'extras'], function () {
  return _gulp2.default.src('dist/**/*').pipe($.size({ title: 'build', gzip: true }));
});

_gulp2.default.task('default', ['clean'], function () {
  _gulp2.default.start('build');
});
