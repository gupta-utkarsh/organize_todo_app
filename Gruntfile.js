module.exports = function(grunt){
	grunt.initConfig({
		pkg : grunt.file.readJSON('package.json'),
		sass: {
			dist: {
				files : {
					'public/src/css/style.css' : 'public/src/scss/style.scss'
				}
			}
		},
		watch: {
			scss: {
				files: 'public/src/scss/**/*.scss',
				tasks : ['sass']
			},
			js: {
				files : 'public/src/js/**/*.js',
				tasks : ['uglify']
			},
			img : {
				files : 'public/src/img/**/*.{png,jpg,gif}',
				tasks : ['imagemin']
			},
			cssmin : {
				files : 'public/src/css/**/*.css',
				tasks : ['cssmin']
			}
		},
		imagemin: {
		   dist: {
		      options: {
		        optimizationLevel: 5
		      },
		      files: [{
			        expand: true,
			        cwd: 'public/src/img',
			        src: ['**/*.{png,jpg,gif}'],
			        dest: 'public/img'
		      }]
		   }
		},
		uglify: {
		   dist: {
		      options: {
			        banner: '/*! script.js 1.0.0 | Utkarsh Gupta | MIT Licensed */'
		      },
		      files: {
		            'public/js/script.min.js' : 'public/src/js/script.js'
		      }
		   }
		},
		cssmin: {
		   dist: {
		      options: {
		         banner: '/*! style.css 1.0.0 | Utkarsh Gupta | MIT Licensed */'
		      },
		      files: {
		         'public/css/style.min.css': 'public/src/css/style.css'
		      }
		  }
		}
	});
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-imagemin');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.registerTask('default',["watch","sass","imagemin","uglify","cssmin"]);
}
