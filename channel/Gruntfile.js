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
                        "<%= pkg.dev %>/scss",
                        "bower_components/*"
                    ]
                },
                files: {
                    "<%= pkg.dev %>/css/main.css": "<%= pkg.dev %>/scss/main.scss"
                }
			}
		},

		watch: {
			css: {
				files: [
                    '<%= pkg.dev %>/scss/**/*.scss',
                    '<%= pkg.dev %>/less/**/*.less'
                ],
				tasks: ['sass:dev'],
				options: {
					livereload: true,
					spawn:false
				},
			},

			scripts: {
				files: ['<%= pkg.dev %>/js/**/*.js'],
				tasks: [],
				options: {
					livereload: true,
					spawn: false,
				}
			},

			images: {
				files: ['<%= pkg.dev %>/img/**/*.{png,jpg,gif}'],
				tasks: [],
				options: {
					livereload: true,
					spawn: false,
				}
			},

			html:{
				files: ['<%= pkg.dev %>/**/*.html'],
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
				files: ['<%= pkg.dev %>/css/**/*.css']
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
