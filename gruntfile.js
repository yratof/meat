module.exports = function(grunt) {
 
  grunt.registerTask('watch', [ 'watch' ]);
  
  grunt.initConfig({
    
    // Make JS tiny
    uglify: {
      options: {
        mangle: false
      },
      js: {
        files: {
          'library/js/main.min.js': ['library/js/main.min.js']
        }
      }
    },

    // Minify Images
    imagemin: {
      dynamic: {
        files: [{
          expand: true,
          cwd: 'img',
          src: ['**/*.{png,jpg,gif,svg}'],
          dest: 'img'
        }]
      }
    },
    
    // Compile SCSS
    sass: {
      dist: {     
        options: { 
          style: 'expanded',
          loadPath: require('node-bourbon').includePaths
        },   
        files: {
          'library/css/style.css' : 'library/scss/style.scss',
          'library/css/ie.css' : 'library/scss/ie.scss',
          'library/css/login.css' : 'library/scss/login.scss'
        }
      }
    },
    
    // Combine MQ's, but lose critical css
    combine_mq: {
      target: {
        files: {
          'library/css/ie.css': ['library/css/ie.css'],
          'library/css/style.css': ['library/css/style.css'],
          'library/css/login.css': ['library/css/login.css']
        },
        options: {
          beautify: false
        }
      }
    },

    // See your changes in the browser as they happen.
    browserSync: {
      default_options: {
        bsFiles: {
          src: [
            "library/css/*.css",
            "*.php,",
            "**/*.php,"
          ]
        },
        options: {
          watchTask: true,
          proxy: "fullphatdesign.local"
        }
      }
    },

    // Autoprefix
    postcss: {
        options: {
            map: false,
            processors: [
                require('autoprefixer-core')({
                    browsers: ['> 20%', 'last 10 versions', 'Firefox > 20']
                })
            ],
            remove: false
        },
        dist: {
            src: 'library/css/*.css'
        }
    },
    
    // Import whole folder into a file 
    sass_globbing: {
      target: {
        files: {
          'library/scss/components.scss': 'library/scss/components/*.scss'
        }
      }
    },
    
    // Watch for any changes
    watch: {
      js: {
        files: ['library/js/*.js'],
        tasks: ['uglify:js']
      },
      css: {
        // Watch sass changes, then process new images and merge mqs
        files: ['library/scss/*.scss', 'library/scss/**/*.scss'],
        tasks: ['sass_globbing:target', 'sass', 'combine_mq:target', 'postcss:dist', 'browserSync' ]
      },
      options: {
          spawn: false // Very important, don't miss this
      }
    }
  });
 
  // Register everything used
  grunt.loadNpmTasks('grunt-newer');
  grunt.loadNpmTasks('grunt-combine-mq');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-sass-globbing');
  grunt.loadNpmTasks('grunt-postcss');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-browser-sync');
  grunt.loadNpmTasks('grunt-contrib-imagemin');
 
  // Run everything with 'grunt', these need to be in
  // a specific order so they don't fail.
  grunt.registerTask('default', [
    'uglify', 
    'sass_globbing:target', // Glob together needed folders
    'sass', // Run sass
    'combine_mq', // Combine MQ's
    'postcss:dist', // Post Process with Auto-Prefix
    'newer:imagemin:dynamic', // Compress all images
    'browserSync', // live reload
    'watch' // Keep watching for any changes
  ]);

};
