// Project paths
var project     = 'fredrikDykare';
var src         = './src/';
var build       = './build/';
var dist        = './dist/' + project + '/';
var assets      = './assets/';
var bower       = './bower_components/';
var composer    = './vendor/';
var modules     = './node_modules/';

// Project settings
module.exports = {
  browsersync: {
    files: [build + '/**', '!' + build + '/**.map'],
    notify: false,
    open: true, // Set to false if you don't like the browser window opening automatically
    port: 3000,
    proxy: 'wordpress.local:80/wordpress',
    watchOptions: {
      // This introduces a small delay when watching for
      // file change events to avoid triggering too many reloads
      debounceDelay: 2000
    }
  },

  images: {
    // Copies images from `src` to `build`; does not optimize
    build: {
      src: src + '**/*(*.png|*.jpg|*.jpeg|*.gif|*.svg)',
      dest: build
    },
    dist: {
      // The source is actually `dist` since we are minifying images in place
      src: [dist + '**/*(*.png|*.jpg|*.jpeg|*.gif|*.svg)', '!' + dist + 'screenshot.png'],
      imagemin: {
        optimizationLevel: 7,
        progressive: true,
        interlaced: true
      },
      dest: dist
    }
  },

  livereload: {
    // This is a standard port number that should be recognized by your LiveReload helper
    // there's probably no need to change it
    port: 35729
  },

  scripts: {
    // Bundles are defined by a name and an array of chunks (below) to concatenate;
    // warning: this method offers no dependency management!
    bundles: {
      core: ['core'],
      pageloader: ['pageloader', 'core']
    },
    // Chunks are arrays of paths or globs matching a set of source files; this way you can organize a bunch of scripts that go together into pieces that can then be bundled (above)
    chunks: {
      // The core chunk is loaded no matter what;
      // put essential scripts that you want loaded by your theme in here
      core: [
        // The modules directory contains packages downloaded via npm
        modules + 'timeago/jquery.timeago.js',
        src + 'js/responsive-menu.js',
        src + 'js/core.js'
      ],
      // The pageloader chunk provides an example of how you would add a user-configurable
      // feature to your theme; you can delete this if you wish
      // Have a look at the `src/inc/assets.php` to see how script bundles
      // could be conditionally loaded by a theme
      pageloader: [
        modules + 'html5-history-api/history.js',
        modules + 'spin.js/spin.js',
        modules + 'spin.js/jquery.spin.js',
        modules + 'wp-ajax-page-loader/wp-ajax-page-loader.js',
        src + 'js/page-loader.js'
      ]
    },
    dest: build + 'js/',
    lint: {
      src: [src + 'js/**/*.js']
    },
    minify: {
      src: build + 'js/**/*.js',
      uglify: {},
      dest: build + 'js/'
    },
    namespace: 'wp-'
  },

  styles: {
    build: {
      src: src + 'scss/**/*.scss',
      dest: build
    },
    compiler: 'libsass',
    cssnano: {
      autoprefixer: {
        add: true,
        browsers: ['> 3%', 'last 2 versions', 'ie 9', 'ios 6', 'android 4']
      }
    },
    libsass: {
      // Adds Bower and npm directories to the load path so you can @import directly
      includePaths: ['./src/scss', bower, modules],
      precision: 6,
      onError: function(err) {
        return console.log(err);
      }
    }
  },

  theme: {
    lang: {
      src: src + 'languages/**/*',
      dest: build + 'languages/'
    },
    php: {
      // This simply copies PHP files over; both this and the previous task could be combined if you like
      src: src + '**/*.php',
      dest: build
    }
  },

  utils: {
    clean: [build + '**/.DS_Store'],
    wipe: [dist],
    dist: {
      src: [build + '**/*', '!' + build + '**/*.map'],
      dest: dist
    },
    normalize: {
      src: modules + 'normalize.css/normalize.css',
      dest: src + 'scss',
      rename: '_normalize.scss'
    }
  },

  // What to watch before triggering each specified task;
  // if files matching the patterns below change it will trigger BrowserSync
  watch: {
    src: {
      styles:       src + 'scss/**/*.scss',
      scripts:      src + 'js/**/*.js',
      images:       src + '**/*(*.png|*.jpg|*.jpeg|*.gif|*.svg)',
      theme:        src + '**/*.php',
      livereload:   build + '**/*'
    },
    //  BrowserSync ('browsersync') and Livereload ('livereload')
    watcher: 'livereload'
  }
};
