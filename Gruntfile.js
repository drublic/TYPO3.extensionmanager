/*globals module */
module.exports = function (grunt) {

	// Project configuration.
	grunt.initConfig({
		pkg: '<json:package.json>',
		meta: {
			banner: '/*! <%= pkg.name %> - v<%= pkg.version %> - ' +
			'<%= grunt.template.today("yyyy-mm-dd") %> */'
		},

		lint: {
			all: [
				'Gruntfile.js'
			]
		},

		jshint: {
			options: {
				curly: true,
				eqeqeq: true,
				immed: true,
				latedef: true,
				newcap: true,
				noarg: true,
				sub: true,
				undef: true,
				boss: true,
				eqnull: true,
				browser: true
			},
			globals: {
				jQuery: true
			}
		},

		concat: {
			deploy: {
				src: [],
				dest: ''
			}
		},

		rubysass: {
			dev: {
				options: {
					unixNewlines: true,
					style: 'extended'
				},
				files: {
					'Resources/Public/Css/main.css': 'Resources/Private/Scss/main.scss'
				}
			},
			deploy: {
				options: {
					style: 'compressed'
				},
				files: {
					'Resources/Public/Css/main.css': 'Resources/Private/Scss/main.scss'
				}

			}
		},

		min: {
			deploy: {
				src: ['<config_process:meta.banner>', '<config:concat.deploy.dest>'],
				dest: ''
			}
		},

		watch: {
			scss: {
				files: ['Resources/Private/Scss/**/*.scss'],
				tasks: 'rubysass:dev'
			},

			js: {
				files: '<config:lint.all>',
				tasks: 'lint'
			}
		}
	});

	// Load some stuff
	grunt.loadNpmTasks('grunt-sass');


	// A task for development
	grunt.registerTask('dev', 'lint rubysass:dev');

	// A task for deployment
	grunt.registerTask('deploy', 'lint concat rubysass:deploy min');

	// Default task
	grunt.registerTask('default', 'lint concat rubysass:dev min');

};
