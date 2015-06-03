module.exports = function(grunt) {

    // Load grunt tasks automatically
    require('load-grunt-tasks')(grunt);

    // Time how long tasks take. Can help when optimizing build times
    require('time-grunt')(grunt);

    // Initial config
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        sass: {
            src: {
                options: {
                    paths: [
                        "<%= pkg.public %>/scss",
                        "bower_components/*"
                    ]
                },
                files: {
                    "<%= pkg.public %>/css/admin.css": "<%= pkg.public %>/scss/admin.scss",
                    "<%= pkg.public %>/css/site.css": "<%= pkg.public %>/scss/site.scss"
                }
            }
        },

        watch: {
            css: {
                files: ['<%= pkg.public %>/scss/**/*.scss'],
                tasks: ['sass:src'],
                options: {
                    livereload: true,
                    spawn:false
                },
            },

            scripts: {
                files: ['<%= pkg.public %>/js/**/*.js'],
                tasks: [],
                options: {
                    livereload: true,
                    spawn: false,
                }
            },

            images: {
                files: ['<%= pkg.public %>/img/**/*.{png,jpg,gif}', '<%= pkg.public %>/img/*.{png,jpg,gif}'],
                tasks: [],
                options: {
                    livereload: true,
                    spawn: false,
                }
            },

            html:{
                files: ['<%= pkg.public %>/**/*.html'],
                tasks: [],
                options: {
                    livereload: true,
                    spawn: false
                }
            },

            views:{
                files: ['<%= pkg.app %>/views/**/*.php'],
                tasks: [],
                options: {
                    livereload: true,
                    spawn: false
                }
            },

            livereload: {
                options: {
                    livereload: true
                },
                files: ['<%= pkg.public %>/css/**/*.css']
            }

        },

        copy: {
            build: {
                files: [{
                    expand: true,
                    dot: true,
                    cwd: '<%= pkg.public %>',
                    dest: '<%= pkg.build %>',
                    src: [
                        '*.{ico,png,txt,json}',
                        '.htaccess',
                        '*.html',
                        'css/*',
                        'img/**/*',
                        'fonts/*',
                        'views/*',
                        'templates/* '
                    ]
                }]
            }
        },

        ngAnnotate: {
            dist: {
                files: [{
                    expand: true,
                    cwd: '.tmp/concat/js',
                    src: '*.js',
                    dest: '.tmp/concat/js'
                }]
            }
        },

        useminPrepare: {
            html: '<%= pkg.public %>/index.html',
            options: {
                dest: '<%= pkg.build %>',
                flow: {
                    html: {
                        steps: {
                            js: ['concat', 'uglifyjs'],
                        },
                        post: {}
                    }
                }
            }
        },

        usemin: {
            html: ['<%= pkg.build %>/{,*/}*.html'],
            options: {
                publicDirs: ['<%= pkg.build %>','<%= pkg.build %>/images']
            }
        },
    });

    // Default
    grunt.registerTask('default', [
        'sass:src', 
        'watch'
    ]);

    // Build
    grunt.registerTask('build', [
        'sass:src', 
        'useminPrepare',
        'copy:build',
        'concat',
        'ngAnnotate',
        'uglify',
        'usemin',
    ]);
};