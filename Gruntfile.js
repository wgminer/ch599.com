module.exports = function(grunt) {

	// Initial config
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
                        "<%= pkg.devLoc %>/scss",
                        "bower_components/*"
                    ]
                },
                files: {
                    "<%= pkg.devLoc %>/css/main.css": "<%= pkg.devLoc %>/scss/main.scss"
                }
			}
		},

        less: {
            dev: {
                options: {
                    paths: [
                        '<%= pkg.devLoc %>/less',
                        'bower_components/*'
                    ]
                },
                files: {
                    '<%= pkg.devLoc %>/css/main.css': '<%= pkg.devLoc %>/less/main.less'
                }
            },
        },

		watch: {
			css: {
				files: [
                    '<%= pkg.devLoc %>/scss/**/*.scss',
                    '<%= pkg.devLoc %>/less/**/*.less'
                ],
				tasks: ['sass:dev'],
				options: {
					livereload: true,
					spawn:false
				},
			},

			scripts: {
				files: ['<%= pkg.devLoc %>/js/**/*.js'],
				tasks: [],
				options: {
					livereload: true,
					spawn: false,
				}
			},

			images: {
				files: ['<%= pkg.devLoc %>/img/**/*.{png,jpg,gif}'],
				tasks: [],
				options: {
					livereload: true,
					spawn: false,
				}
			},

			html:{
				files: ['<%= pkg.devLoc %>/**/*.html'],
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
				files: ['<%= pkg.devLoc %>/css/**/*.css']
			}

		}

	});

	// Default
	grunt.registerTask('default', [
        'less:dev', 
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

	//Load Tasks
	grunt.loadNpmTasks('grunt-contrib-connect');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-sass');

};
