module.exports = function(grunt) {

    require('load-grunt-tasks')(grunt);
    require('time-grunt')(grunt);

	grunt.initConfig({

		pkg: grunt.file.readJSON('package.json'),

		connect:{
			options: {
                port: 9000,
                livereload: 35729,
                hostname: 'localhost'
            },
            livereload: {
                options: {
                    open: true,
                    middleware: function (connect) {
                        return [
                            connect().use(
                                '/bower_components',
                                connect.static('./bower_components')
                            ),
                            connect.static('dev')
                        ];
                    }
                }
            },
		},

		sass: {
			dev: {
			    options: {
                    paths: [
                        "<%= pkg.admin %>/scss",
                        "<%= pkg.channel %>/scss",
                        "bower_components/*"
                    ]
                },
                files: {
                    "<%= pkg.admin %>/css/main.css": "<%= pkg.admin %>/scss/main.scss",
                    "<%= pkg.channel %>/css/main.css": "<%= pkg.channel %>/scss/main.scss"
                }
			}
		},

		watch: {
			css: {
				files: [
                    '<%= pkg.admin %>/scss/*.scss',
                    '<%= pkg.channel %>/scss/*.scss'
                ],
				tasks: ['sass:dev'],
				options: {
					livereload: true,
					spawn:false
				},
			},

			scripts: {
				files: [
                    '<%= pkg.admin %>/js/*.js',
                    '<%= pkg.channel %>/js/*.js'
                ],
				tasks: [],
				options: {
					livereload: true,
					spawn: false,
				}
			},

            php: {
                files: ['<%= pkg.app %>/views/*.php'],
                tasks: [],
                options: {
                    livereload: true,
                    spawn: false
                }
            },

			html: {
				files: [
                    '<%= pkg.admin %>/views/*.html',
                    '<%= pkg.channel %>/views/*.html'
                ],
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
                files: [
                    '<%= pkg.admin %>/css/main.css',
                    '<%= pkg.channel %>/css/main.css'
                ]
			}

		}

	});

	// Default
	grunt.registerTask('default', [
        'sass:dev', 
        'connect', 
        'watch'
    ]);

    // Deploy
    grunt.registerTask('deploy', '', function() {
        grunt.task.run([
            // Deploy task...
        ]);
    });

};
