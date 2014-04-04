// Gruntfile
module.exports = function(grunt) {

	// Load all grunt tasks
	require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

	// Initialize the config object
	grunt.initConfig({
		//Task configuration
		compass: {
			dev: {
				options: {
					environment: 'development',
					config: 'config.rb',
					outputStyle: 'expanded'
				},
				files: {
					'app/assets/public/css/main.css': 'app/assets/sass/main.scss'
				}
			},
			dist: {
				options: {
					environment: 'production',
					config: 'config.rb',
					outputStyle: 'compressed'
				},
				files: {
					'app/assets/public/css/main.css': 'app/assets/sass/main.scss'
				}
			}
		},
		concat: {
			options: {
				separator: ';',
			},
			js: {
				src: [
					'./bower_components/jquery/jquery.js',
					'./app/assets/js/*.js'
				],
				dest: './app/assets/public/js/main.js'
			}
		},
		uglify: {
			options: {
				mangle: false // change names of functions?
			},
			js: {
				files: {
					'./app/assets/public/js/main.js': './app/assets/public/js/main.js'
				}
			}
		},
		livereload: {
			sass: {
				files: ['app/assets/sass/**/*.scss'],
				tasks: ['compass:dev']
			},
			js: {
				files: ['app/assets/js/*.js'], // 'components/**/*.js'
				tasks: ['concat', 'uglify']
			},
			livereload: {
				files: ['app/views/*.php', 'app/assets/public/css/*.css', 'app/assets/public/images/*', 'app/assets/public/js/*.js'],
				options: {
					livereload: true
				}
			}
		},
		watch: {
			sass: {
				files: ['app/assets/sass/**/*.scss'],
				tasks: ['compass:dev']
			},
			js: {
				files: ['app/assets/js/*.js'], // 'components/**/*.js'
				tasks: ['concat', 'uglify']
			}
		}
	});

	// Register Tasks
	grunt.registerTask('default', ['watch']);
	grunt.registerTask('make', ['compass:dist', 'concat', 'uglify']);

};


